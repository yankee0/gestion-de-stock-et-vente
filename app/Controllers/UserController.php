<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
            "users" => $model->find()
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
            ->to("/tableau-de-bord");
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
        return view("dashboard");
    }
}
