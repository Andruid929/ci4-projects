<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddApproverIdColumnToRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("requests",
            [
                "approver_id" => [
                    "type" => "VARCHAR",
                    "constraint" => 10,
                    "after" => "status"
                ]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn("requests", ["approver_id"]);
    }
}
