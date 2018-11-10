<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    
    protected $table = 'curriculum_information';
    public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'semester','curr_year','curr_program_id','curr_course_id'

    ];

    public function currprograms()
    {
        return $this->belongsTo('App\Program','curr_program_id');
    }

    public function currcourses()
    {
        return $this->belongsTo('App\Courses','curr_course_id');

    }


}
