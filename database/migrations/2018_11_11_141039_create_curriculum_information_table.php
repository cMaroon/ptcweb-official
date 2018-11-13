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
            $table->integer('semester')->unsigned();
            $table->integer('curr_year')->unsigned();
            $table->integer('curr_program_id')->unsigned();
            $table->integer('curr_course_id')->unsigned();
            $table->integer('curr_section_id')->unsigned();
            $table->string('sched_days')->nullable();
            $table->string('sched_time')->nullable();
            $table->string('sched_room')->nullable();
            $table->timestamps();

            $table->foreign('curr_program_id')->references('id')->on('programs_information')->onDelete('cascade');
            $table->foreign('curr_course_id')->references('id')->on('courses_information')->onDelete('cascade');
            $table->foreign('curr_section_id')->references('id')->on('section')->onDelete('cascade');
            $table->foreign('semester')->references('id')->on('semester')->onDelete('cascade');
            $table->foreign('curr_year')->references('id')->on('year_level')->onDelete('cascade');
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
