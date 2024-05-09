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
        }

        return view("items/index", [
            "items" => $model->find()
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $model = new ItemModel();

        try {
            $model->insert($data);
            return redirect()
                ->back()
                ->with("message", "Ajout réussie");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with("error", $th->getMessage());
        }
    }

    public function delete($id)
    {
        $model = new ItemModel();
        $model->delete($id);
        return redirect()
            ->back()
            ->with("message", "Suppression réussie");
    }

    public function update()
    {
        $data = $this->request->getPost();
        $model = new ItemModel();
        try {
            $model->save($data);
            return redirect()
                ->back()
                ->with("message", "Modifications enregistrées");
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with("error", $th->getMessage());
        }
    }
}
