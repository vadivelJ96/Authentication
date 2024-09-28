<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveBranchFieldFromUsers extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('users', 'branch');
    }

    public function down()
    {
        // Add the column back in case of rollback
        $this->forge->addColumn('users', [
            'branch' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }
}

