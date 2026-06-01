<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddApproverIdColumnToRequestTables extends Migration
{
    public function up()
    {
        $this->forge->addColumn('leave_apps', [
            'approver_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
                'after' => 'status',
            ],
        ]);

        $this->forge->addColumn('inter_reqs', [
            'approver_id' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
                'after' => 'description',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('leave_apps', 'approver_id');
        $this->forge->dropColumn('inter_reqs', 'approver_id');
    }
}
