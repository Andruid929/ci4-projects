<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmployeeIdColumnToUsersTable extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn("users",[
            "employee_id" => [
                "type" => "VARCHAR",
                "constraint" => "10",
                "null" => false,
                "after" => "id"
            ]
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn("users", "employee_id");
    }
}
