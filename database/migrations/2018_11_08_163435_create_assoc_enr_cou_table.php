<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssocEnrCouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assoc_enr_cou', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assoc_form_id')->reference('form_id')->on('enrollment_information');
            $table->string('assoc_course_id')->reference('id')->on('courses_information');
            $table->string('assoc_curr_id')->reference('id')->on('curriculum_information');
            $table->string('advising_status')->nullable();
            $table->string('fee_status')->nullable();
            $table->timestamps();


            $table->foreign('enr_id_num')->references('id_num')->on('student_information')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assoc_enr_cou');
    }
}
