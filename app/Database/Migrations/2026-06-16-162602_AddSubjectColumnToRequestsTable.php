<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubjectColumnToRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("requests",
            [
                "subject" => [
                    "type" => "VARCHAR",
                    "constraint" => 30,
                    "after" => "is_leave"
                ]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn("requests", ["subject"]);
    }
}
