<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCountryTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id"=> ["type"=> "Int","constraint"=> 11,"auto_increment"=> true,],
            "country_name"=> ["type"=> "VARCHAR","constraint"=> 255,"null"=> true],
        ]);

        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("country");
    }

    public function down()
    {
        //
        $this->forge->dropTable("country");
    }
}
