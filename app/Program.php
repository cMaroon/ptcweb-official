<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    
    protected $table = 'programs_information';

    //Database Tables
    protected $fillable = [
        'program_code','descriptive_title'

    ];

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

}
