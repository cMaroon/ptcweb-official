<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculumInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('semester');
            $table->string('curr_year');
            $table->integer('curr_program_id')->unsigned();
            $table->integer('curr_course_id')->unsigned();
            $table->timestamps();

            $table->foreign('curr_program_id')->references('id')->on('programs_information')->onDelete('cascade');
            $table->foreign('curr_course_id')->references('id')->on('courses_information')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_information');
        
    }
}
