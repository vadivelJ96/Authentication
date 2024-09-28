<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStateTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id"=> ["type"=> "INT","constraint"=> 11,"unsigned"=> true,"auto_increment"=>true],
            "state_name"=> ["type"=> "VARCHAR","constraint"=> 255,"null"=> true],
            "country_id"=>["type"=> "INT", "constraint"=>11 , "unsigned"=> true],
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable('state');
    }

    public function down()
    {
        //
        $this->forge->dropTable('state');
    }
}
