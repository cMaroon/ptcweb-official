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
            $table->integer('assoc_form_id')->unsigned();
            $table->integer('assoc_curr_id')->unsigned();
            $table->integer('assoc_prof_id')->unsigned()->nullable();
            $table->string('assoc_final_grade')->nullable();
            $table->string('advising_status')->default('not yet approve');
            $table->timestamps();

            $table->foreign('assoc_form_id')->references('id')->on('enrollment_information')->onDelete('cascade');
            $table->foreign('assoc_curr_id')->references('id')->on('curriculum_information')->onDelete('cascade');
            $table->foreign('assoc_prof_id')->references('id')->on('instructor_information')->onDelete('cascade');





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
