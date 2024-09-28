<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingColumnToUserTable extends Migration
{
    public function up()
    {
        //adding the profile pic path column in users table
        $this->forge->addColumn('users',[
            'profilePicPath'=>[
               'type'=> 'VARCHAR',
               'constraint'=>'255',
               'null'   => true,
            ]
            ]);
    }

    public function down()
    {
        //deleting the profile Pic path column in users table
        $this->forge->dropColumn('users','profilePicPath');
    }
}
