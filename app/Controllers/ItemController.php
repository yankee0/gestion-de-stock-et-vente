<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class ItemController extends BaseController
{
    public function index()
    {
        $r = $this->request->getGet("r");
        $model = new ItemModel();
        if ($r) {
            $model->like("name", $r);
            $model->orLike("profile", $r);
            $model->orLike("login", $r);
        }

        return view("users/index", [
            "users" => $model->find()
        ]);
    }
}
