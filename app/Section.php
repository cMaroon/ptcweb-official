<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
    protected $table = 'section';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'title'

    ];



}
