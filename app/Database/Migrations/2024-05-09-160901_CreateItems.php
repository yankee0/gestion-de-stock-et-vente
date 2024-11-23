<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItems extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'unique' => true
            ],
            'quantity' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'price_per_unit' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("items");
    }

    public function down()
    {
        $this->forge->dropTable("items");
    }
}
