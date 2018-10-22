<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    protected $connection = 'mysql2';
    protected $table = 'student_information';
    protected $fillable = ['id_num','firstname', 'lastname'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
