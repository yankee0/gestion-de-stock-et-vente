<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Yankee extends Seeder
{
    public function run()
    {
        $this->db->table("users")->insert([
            "name" => "Elhadji",
            "login" => "yankee",
            "password" => sha1("password"),
            "profile" => "ADMIN"
        ]);
    }
}
