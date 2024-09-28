<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingNewFieldsToUserModel extends Migration
{
    public function up()
    {
        //adding four collumns in user table - user_name , role , status , branch
        $this->forge->addColumn('users',[ 
           'user_name'=>[
            'type'=> 'VARCHAR',
            'constraint'=> 255,
        ],
        'role'=>[
            'type'=> 'VARCHAR',
            'constraint'=> 255,
        ],
        'status'=>[
            'type'=> 'VARCHAR',
            'constraint'=> 255,
        ],
        'branch'=>[
            'type'=> 'VARCHAR',
            'constraint'=> 255,
        ],
    ]);
    }

    public function down()
    {
        //dropping coulms
        $this->forge->dropColumn('users',['user_name','role','status','branch']);
    }
}
