<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentAssoc extends Model
{
    
    protected $table = 'assoc_enr_cou';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'assoc_form_id','assoc_course_id','assoc_curr_id'

    ];

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

}
