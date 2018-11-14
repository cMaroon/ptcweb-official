<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program_code');
            $table->string('descriptive_title');
            $table->integer('advising_id')->unsigned();
            $table->timestamps();

            $table->foreign('advising_id')->references('id')->on('advising_officer')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_information');
    }
}
