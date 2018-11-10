<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_code');
            $table->string('descriptive_title');
            $table->string('lec_hr');
            $table->string('lab_hr');
            $table->integer('course_unit');
            $table->string('course_pre_req')->nullable();
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
        Schema::dropIfExists('courses_information');
    }
}
