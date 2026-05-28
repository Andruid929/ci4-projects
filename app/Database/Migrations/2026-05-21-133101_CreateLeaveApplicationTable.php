<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeaveApplicationTable extends Migration
{

    public function up(): void
    {
        $this->forge->addField([
            "id" => [
                "type"           => "BIGINT",
                "auto_increment" => true,
            ],
            "employee_id" => [
                "type" => "VARCHAR",
                "constraint" => 10
            ],
            "leave_type" => [
                "type" => "ENUM",
                "constraint" => ["sick", "vacation", "personal", "bereavement", "maternity", "unpaid"]
            ],
            "start_date" => [
                "type" => "DATETIME"
            ],
            "end_date" => [
                "type" => "DATETIME"
            ],
            "reason" => [
                "type" => "TEXT",
                "null" => false
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => ["approved", "pending", "denied"]
            ],
            "approver_comment" => [
                "type" => "TEXT"
            ],
            "created_at" => [
                "type" => "DATETIME"
            ],
            "deleted_at" => [
                "type" => "DATETIME"
            ],
            "updated_at" => [
                "type" => "DATETIME"
            ]
        ]);

        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("leave_apps");
    }

    public function down(): void
    {
        $this->forge->dropTable("leave_apps");
    }
}
