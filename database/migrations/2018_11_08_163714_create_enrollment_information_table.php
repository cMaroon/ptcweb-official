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
            $table->integer('enr_form_id')->unsigned();
            $table->string('enr_id_num');
            $table->integer('enr_program_id')->unsigned();
            $table->string('fee_status')->default('not yet paid');


            $table->timestamps();

            $table->foreign('enr_id_num')->references('id_num')->on('student_information')->onDelete('cascade');
            $table->foreign('enr_program_id')->references('id')->on('programs_information')->onDelete('cascade');

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
