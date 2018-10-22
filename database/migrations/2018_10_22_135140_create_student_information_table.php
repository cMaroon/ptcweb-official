<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('student_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_num')->unique();
            $table->string('suffixname')->nullable();
            $table->string('program')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('student_type')->default('old student');
            $table->string('year_level')->nullable();
            $table->string('section')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('religion')->nullable();
            $table->string('dob')->nullable();
            $table->string('ca_st_num')->nullable();
            $table->string('ca_st_name')->nullable();
            $table->string('ca_subd')->nullable();
            $table->string('ca_brgy')->nullable();
            $table->string('ca_city')->nullable();
            $table->string('ca_province')->nullable();
            $table->integer('ca_zipcode')->nullable();
            $table->string('per_st_num')->nullable();
            $table->string('per_st_name')->nullable();
            $table->string('per_subd')->nullable();
            $table->string('per_brgy')->nullable();
            $table->string('per_city')->nullable();
            $table->string('per_province')->nullable();
            $table->integer('per_zipcode')->nullable();
            $table->integer('cd_telno')->nullable();
            $table->string('cd_mobno')->nullable();
            $table->string('lsa_schtype')->nullable();
            $table->string('lsa_schname')->nullable();
            $table->string('lsa_schprogram')->nullable();
            $table->string('lsa_schattended')->nullable();
            $table->string('fa_fname')->nullable();
            $table->string('fa_mname')->nullable();
            $table->string('fa_lname')->nullable();
            $table->string('fa_sname')->nullable();
            $table->string('fa_mobno')->nullable();
            $table->string('fa_email')->nullable();
            $table->string('fa_occu')->nullable();
            $table->string('mo_fname')->nullable();
            $table->string('mo_mname')->nullable();
            $table->string('mo_lname')->nullable();
            $table->string('mo_mobno')->nullable();
            $table->string('mo_email')->nullable();
            $table->string('mo_occu')->nullable();  
            $table->string('gu_fname')->nullable();
            $table->string('gu_mname')->nullable();
            $table->string('gu_lname')->nullable();
            $table->string('gu_sname')->nullable();
            $table->string('gu_mobno')->nullable();
            $table->string('gu_email')->nullable();
            $table->string('gu_occu')->nullable();
            $table->string('gu_rel')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_information');
    }
}
