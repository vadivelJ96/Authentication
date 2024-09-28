<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameColumnInUser extends Migration
{
    public function up()
    {
        //
        $this->forge->modifyColumn('users',[
            'profilePicPath'=> [
                'name'=> 'profilePicName',
                'type'=> 'VARCHAR',
                'constraint' => '255',
            ]
        ]);

    }

    public function down()
    {
        //
        $this->forge->modifyColumn('users',[
            'profilePicName'=> [
                'name'=> 'profilePicPath',
                'type'=> 'VARCHAR',
                'constraint'=> '255',
            ]
            ]);
    }
}
