<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveLeaveRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable("leave_apps");
    }

    public function down()
    {
        $this->forge->addField([
            "id" => [
                "type" => "BIGINT",
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
            "request_type" => [
                "type" => "ENUM",
                "constraint" => ["career_advancement", "compensation", "operational", "administrative"]
            ],
            "subject" => [
                "type" => "VARCHAR",
                "constraint" => 30
            ],
            "description" => [
                "type" => "TEXT"
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
}
