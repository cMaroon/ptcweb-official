<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advising extends Model
{
    
    protected $table = 'advising_officer';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'adivising_officer_name'

    ];




}
