<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    
    protected $table = 'semester';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title'

    ];




}
