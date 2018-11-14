<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    
    protected $table = 'programs_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'program_code','descriptive_title','adivising_id'

    ];

    public function programscurr()
    {
        return $this->hasMany('App\Curriculum');
    }

    public function advisingid()
    {
        return $this->belongsTo('App\Advising','advising_id');
    }




}
