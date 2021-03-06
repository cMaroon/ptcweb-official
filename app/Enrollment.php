<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    
    protected $table = 'enrollment_information';
    // public $primaryKey = 'id';


    //Database Tables
    protected $fillable = [
        'enr_form_id','enr_id_num','enr_program_id','enr_fee_status'

    ];

    public function enrollprograms()
    {
        return $this->belongsTo('App\Program','enr_program_id');
    }

    public function enrollassoc()
    {
        return $this->belongsTo('App\EnrollmentAssoc','enr_form_id');
    }

    public function studinfo()
    {
        return $this->belongsTo('App\Student','enr_id_num','id_num');
    }
}
