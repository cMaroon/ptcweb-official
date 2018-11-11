<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSemandyearlevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('semester')->insert(array(
            'title' => '1st Sem',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('semester')->insert(array(
            'title' => '2nd Sem',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('semester')->insert(array(
            'title' => '3rd Sem',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'First Year',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'Second Year',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'Third Year',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'Fourth Year',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'Grade 11',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

        DB::table('year_level')->insert(array(
            'title' => 'Grade 12',
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
        Schema::dropIfExists('add_semandyearlevel');
    }
}
