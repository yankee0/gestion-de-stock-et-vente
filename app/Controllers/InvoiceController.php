<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceController extends BaseController
{
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
        return view("invoices/create");
    }
}
