<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\ItemModel;
use App\Models\SaleModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class InvoiceController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $r = $this->request->getGet("r");
        $model = new InvoiceModel();
        $model->select("invoices.*, users.name as by");
        $model->join("users", "users.id=user_id", "left");

        if ($r) {
            $model->like("ref", $r);
            $model->orLike("", $r);
        }

        return view("invoices/index", [
            "items" => $model->orderBy("created_at", "desc")->find()
        ]);
    }

    public function delete($id)
    {
        $model = new InvoiceModel();
        $model->delete($id);
        return redirect()
            ->back()
            ->with("message", "Suppression réussie.");
    }

    public function createPage()
    {
        $itemsModel = new ItemModel();
        return view("invoices/create", [
            "items" => $itemsModel->orderBy("name", "asc")->find()
        ]);
    }

    public function create_token()
    {
        return $this->respond(csrf_hash());
    }

    public function get_items()
    {
        $itemsModel = new ItemModel();

        $data = $itemsModel
            ->where("quantity >", 0)
            ->orderBy("name")
            ->findAll();

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getBody();
        $items = json_decode($data, true);

        $db = \Config\Database::connect();
        $db->transBegin();
        $model = new InvoiceModel();
        $invoice = $model->insert([
            "ref" => strtotime(Time::now()),
            "user_id" => session()->user["id"],
        ]);
        $itemModel = new ItemModel();
        $saleModel = new SaleModel();
        foreach ($items as $i) {
            $occ = $itemModel->find($i["id"]);
            if (!$occ) {
                $model->delete($invoice);
                $db->transComplete();
                return $this->fail("Produit indisponible: " . $i["name"]);
            }
            if ($occ["quantity"] < $i["count"]) {
                $model->delete($invoice);
                $db->transComplete();
                return $this->fail("Stock insuffisant: " . $i["name"]);
            }
            $occ["quantity"] -= $i["count"];
            $itemModel->save($occ);
            $saleModel->insert([
                "invoice_id" => $invoice,
                "item_name" => $i["name"],
                "quantity" => $i["quantity"],
                "price_per_unit" => $i["price_per_unit"],
            ]);
        }
        $db->transComplete();
        return $this->respond(base_url("/factures/" . $invoice));
    }
}
