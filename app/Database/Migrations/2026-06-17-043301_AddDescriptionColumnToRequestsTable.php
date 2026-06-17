<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptionColumnToRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("requests",
            [
                "description" => [
                    "type" => "TEXT",
                    "after" => "subject"
                ]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn("requests", ["description"]);
    }
}
