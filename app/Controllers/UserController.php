<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\ItemModel;
use App\Models\SaleModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    public function index()
    {
        $r = $this->request->getGet("r");
        $model = new UserModel();
        if ($r) {
            $model->like("name", $r);
            $model->orLike("profile", $r);
            $model->orLike("login", $r);
        }

        return view("users/index", [
            "users" => $model->orderBy("name", "asc")->find()
        ]);
    }

    public function loginPage()
    {
        return view("login");
    }

    public function login()
    {
        $data = $this->request->getPost();
        $model = new UserModel();

        $user = $model
            ->where("login", $data["login"])
            ->where("password", sha1($data["password"]))
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Identifiants incorrects");
        }

        session()->set("user", $user);
        return redirect()
            ->to($user["profile"] == "ADMIN" ? "/tableau-de-bord" : "factures");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("/");
    }

    public function create()
    {
        if (session()->user["profile"] != "ADMIN") {
            throw new PageNotFoundException();
        }

        $data = $this->request->getPost();
        $data["password"] = sha1($data["password"]);
        $model = new UserModel();

        try {
            $model->insert($data);
            return redirect()
                ->back()
                ->with("message", "Création réussie");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", $th->getMessage());
        }
    }

    public function delete($id)
    {
        if (session()->user["profile"] != "ADMIN") {
            throw new PageNotFoundException();
        }

        $model = new UserModel();
        $model->delete($id);
        return redirect()
            ->back()
            ->withInput()
            ->with("message", "Suppression réussie");
    }

    public function dashboard()
    {
        $salesModel = new SaleModel();
        $userModel = new UserModel();
        $itemModel = new ItemModel();

        //getDaily Sales
        $dailySales = $salesModel
            ->select("SUM(sales.price_per_unit * sales.quantity) as sum")
            ->join("invoices", "invoices.id = sales.invoice_id")
            ->where("DAY(invoices.created_at)", date("d"))
            ->where("MONTH(invoices.created_at)", date("m"))
            ->where("YEAR(invoices.created_at)", date("Y"))
            ->first();

        //getWeekly Sales
        $weeklySales = $salesModel
            ->select("SUM(sales.price_per_unit * sales.quantity) as sum")
            ->join("invoices", "invoices.id = sales.invoice_id")
            ->where("WEEK(invoices.created_at)", date("W"))
            ->where("YEAR(invoices.created_at)", date("Y"))
            ->first();

        //getMonthly Sales
        $monthlySales = $salesModel
            ->select("SUM(sales.price_per_unit * sales.quantity) as sum")
            ->join("invoices", "invoices.id = sales.invoice_id")
            ->where("MONTH(invoices.created_at)", date("m"))
            ->where("YEAR(invoices.created_at)", date("Y"))
            ->first();

        //getAnnual Sales
        $annualSales = $salesModel
            ->select("SUM(sales.price_per_unit * sales.quantity) as sum")
            ->join("invoices", "invoices.id = sales.invoice_id")
            ->where("YEAR(invoices.created_at)", date("Y"))
            ->first();

        //getUsers Count
        $userCount = $userModel->countAllResults();

        //getSales line graphe
        $lineData = [];
        for ($i = 0; $i < 12; $i++) {;
            $lineData[$i] = $salesModel
                ->select("SUM(sales.price_per_unit * sales.quantity) as sum")
                ->join("invoices", "invoices.id = sales.invoice_id")
                ->where("MONTH(invoices.created_at)", date($i))
                ->where("YEAR(invoices.created_at)", date("Y"))
                ->first()["sum"];
        }

        return view("dashboard", [
            "dailySales" => $dailySales,
            "weeklySales" => $weeklySales,
            "monthlySales" => $monthlySales,
            "annualSales" => $annualSales,
            "userCount" => $userCount,
            "lineData" => json_encode($lineData),
            "outOfStocks" => $itemModel
                ->where("quantity", 0)
                ->limit(5)
                ->find()
        ]);
    }
}
