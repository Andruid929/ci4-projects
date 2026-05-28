<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFirstAndLastNameToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn("users", [
            "first_name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ],
            "last_name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn("users", ["first_name", "last_name"]);
    }
}
