<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('programs_information')->insert(array(
            'program_code' => 'ABA',
            'descriptive_title' => 'Associate in Business Administration',
            'advising_id' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'COA',
            'descriptive_title' => 'Certificate in Office Administration',
            'advising_id' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'CCS',
            'descriptive_title' => 'Certificate in Computer Science',
            'advising_id' => '2',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'CHRM',
            'descriptive_title' => 'Certificate in Hotel and Restaurant Management',
            'advising_id' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'BSIT',
            'descriptive_title' => 'Bachelor of Science in Information Technology',
            'advising_id' => '2',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'BSOA',
            'descriptive_title' => 'Bachelor of Science in Office Administration',
            'advising_id' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'BSIT-EXEC',
            'descriptive_title' => 'Executive - Bachelor of Science in Information Technology',
            'advising_id' => '2',        
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'BSOA-EXEC',
            'descriptive_title' => 'Executive - Bachelor of Science in Office Administration',
            'advising_id' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'ABM',
            'descriptive_title' => 'Accountancy, Business and Management',
            'advising_id' => '3',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'HUMSS',
            'descriptive_title' => 'Humanities and Social Science',
            'advising_id' => '3',        
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        DB::table('programs_information')->insert(array(
            'program_code' => 'TECH-VOC ICT',
            'descriptive_title' => 'Tech-Voc Information and Communications Technology',
            'advising_id' => '3',
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
        Schema::dropIfExists('add_program');
    }
}
