<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{

    public function up()
    {
        $this->forge->addField([
            "employee_id" => [
                "type" => "BIGINT",
                "auto_increment" => true
            ],
            "employee_code" => [
                "type" => "VARCHAR",
                "constraint" => 32,
            ],
            "first_name" => [
                "type" => "VARCHAR",
                "constraint" => 30
            ],
            "last_name" => [
                "type" => "VARCHAR",
                "constraint" => 30
            ],
            "gender" => [
                "type" => "ENUM",
                "constraint" => ["m", "f", "r"]
            ],
            "phone_number" => [
                "type" => "VARCHAR",
                "constraint" => 25
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
                "unique" => true
            ],
            "department" => [
                "type" => "VARCHAR",
                "constraint" => 20
            ],
            "job_title" => [
                "type" => "VARCHAR",
                "constraint" => 20
            ],
            "employment_type" => [
                "type" => "ENUM",
                "constraint" => ["full-time", "part-time", "contract"]
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => ["active", "inactive", "terminated"]
            ],
            "date_joined" => [
                "type" => "DATETIME"
            ],
            "probation_end_date" => [
                "type" => "DATETIME",
                "null" => true
            ],
            "created_at" => [
                "type" => "DATETIME"
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true
            ],
            "deleted_at" => [
                "type" => "DATETIME",
                "null" => true
            ]
        ]);

        $this->forge->addKey("employee_id", true);
        $this->forge->createTable("employees");
    }

    public function down()
    {
        $this->forge->dropTable("employees");
    }
}