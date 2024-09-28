<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUserTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('users',[
          'address1'=> [
            'type'=> 'VARCHAR',
            'constraint'=> '255',
          ],
          'address2'=> [
            'type'=> 'VARCHAR',
            'constraint'=>'255',
          ],
          'address3'=>[
           'type'=> 'VARCHAR',
           'constraint'=>'255',
          ],
          'country_id'=>[
            'type'=> 'INT',
            'constraint'=>'11'
          ]
          ,
          'state_id'=>[
           'type'=> 'INT',
           'constraint'=>'11',
          ],
          'city_id'=>[
            'type'=>'INT',
            'constraint'=>'11'
          ]
        ]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('users',['address1','address2','address3','country_id','state_id','city_id']);
    }
}
