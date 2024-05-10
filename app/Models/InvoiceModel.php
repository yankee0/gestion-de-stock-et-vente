<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id", "ref", "user_id"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ["getSales"];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function getSales($data)
    {
        for ($i = 0; $i < count($data["data"]); $i++) {

            $data["data"][$i]["sum"] = 0;
            $data["data"][$i]["sales"] = (new SaleModel())->where("invoice_id", $data["data"][$i]["id"])->find();
            foreach ($data["data"][$i]["sales"] as $sale) {
                $data["data"][$i]["sum"] += ($sale["price_per_unit"] * $sale["quantity"]);
            }
        }
        
        return $data;
    }
}
