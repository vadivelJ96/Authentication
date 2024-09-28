<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCityTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id"=> ["type"=> "Int","constraint"=> 11,"auto_increment"=> true,],
            "city_name"=> ["type"=> "VARCHAR","constraint"=> 255,"null"=> true],
            "state_id"=> ["type"=> "INT","constraint"=> 11,]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("city");
    }

    public function down()
    {
        //
        $this->forge->dropTable("city");
    }
}
