<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'invoice_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'quantity' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'price_per_unit' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->addForeignKey("invoice_id", "invoices", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("sales");
    }

    public function down()
    {
        $this->forge->dropTable("sales");
    }
}
