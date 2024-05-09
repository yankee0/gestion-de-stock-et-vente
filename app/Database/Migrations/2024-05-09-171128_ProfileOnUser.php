<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfileOnUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn("users", [
            'profile' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => "id",
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
