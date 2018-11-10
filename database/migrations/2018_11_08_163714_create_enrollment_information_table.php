<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_id')->unique();
            $table->string('enr_id_num')->references('id')->on('student_information');
            $table->string('enr_program_id')->references('id')->on('programs_information');

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
        Schema::dropIfExists('enrollment_information');
    }
}
