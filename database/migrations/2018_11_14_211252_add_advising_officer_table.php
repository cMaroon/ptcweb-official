<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvisingOfficerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('advising_officer')->insert(array(
            'id' => '1',
            'advising_officer_name' => 'Prof. Gloria Garcia',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('advising_officer')->insert(array(
            'id' => '2',
            'advising_officer_name' => 'Prof. Cornelio Lamera',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('advising_officer')->insert(array(
            'id' => '3',
            'advising_officer_name' => 'Prof. ',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
