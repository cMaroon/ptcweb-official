<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddSuperadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(array(
            'id_num' => 'superadmin01',
            'name' => 'Super Admin',
            'email' => 'itstaff.ptc@gmail.com',
            'password' => Hash::make('admin'),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
            'usertype' => 'superadmin',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_superadmin');
    }
}
