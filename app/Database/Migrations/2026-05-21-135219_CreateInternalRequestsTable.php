<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInternalRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type"           => "BIGINT",
                "auto_increment" => true,
            ],
            "employee_id" => [
                "type" => "VARCHAR",
                "constraint" => 10,
            ],
            "request_type" => [
                "type" => "ENUM",
                "constraint" => ["career_advancement", "compensation", "operational", "administrative"]
            ],
            "subject" => [
                "type" => "VARCHAR",
                "constraint" => 30
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => ["approved", "pending", "denied"]
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
        $this->forge->createTable("inter_reqs");
    }

    public function down()
    {
        $this->forge->dropTable("inter_reqs");
    }
}
