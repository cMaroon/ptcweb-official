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
            $table->string('curr_program_id')->references('id')->on('programs_information');
            $table->string('curr_course_id')->reference('id')->on('courses_information');


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
        Schema::dropIfExists('curriculum_information');
    }
}
