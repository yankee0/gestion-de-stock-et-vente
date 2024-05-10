<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\ItemModel;
use CodeIgniter\API\ResponseTrait;

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
}
