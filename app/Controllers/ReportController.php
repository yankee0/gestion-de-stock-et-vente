<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\UserModel;

class ReportController extends BaseController
{
    public function index()
    {
        $invoiceModel = new InvoiceModel();
        $reqs = $this->request->getGet();
        $invoiceModel
            ->select("invoices.*, users.name as by")
            ->join("users", "users.id=user_id", "left");

        if (!empty($reqs)) {
            $invoiceModel
                ->where("invoices.created_at >=", $reqs["from"])
                ->where("invoices.created_at <=", $reqs["to"]);

            if ($reqs["by"] != "all") {
                $invoiceModel->where("user_id", $reqs["by"]);
            }
        }

        return view("report", [
            "invoices" => empty($reqs) ? [] : $invoiceModel
                ->orderBy("created_at", "desc")
                ->find(),
            "users" => (new UserModel())->findAll()
        ]);
    }
}
