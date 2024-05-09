<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TimeOnInvoices extends Migration
{
    public function up()
    {
        $this->forge->addColumn("invoices", [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
