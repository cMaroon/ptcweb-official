<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearLevel extends Model
{
    
    protected $table = 'year_level';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title'

    ];




}
