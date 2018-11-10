<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    // protected $connection = 'mysql2';
    protected $table = 'student_information';
    public $primaryKey = 'id';

    //Database Tables
    protected $fillable = [
        'id_num','firstname', 'middlename' ,'lastname','cd_email','program_id','year_level','section',
        'suffixname','scholarship','sex','civil_status','citizenship','birthplace','religion','dob',
        'ca_st_num','ca_st_name','ca_subd','ca_brgy','ca_city','ca_province','ca_zipcode',
        'per_st_num','per_st_name','per_subd','per_brgy','per_city','per_province','per_zipcode',
        'cd_telno','cd_mobno','lsa_schtype','lsa_schname','lsa_schprogram','lsa_schattended',
        'fa_fname','fa_mname','fa_lname','fa_sname','fa_mobno','fa_email','fa_occu',
        'mo_fname','mo_mname','mo_lname','mo_mobno','mo_email','mo_occu',
        'gu_fname','gu_mname','gu_lname','gu_sname','gu_mobno','gu_email','gu_occu','gu_rel'

    ];

    public function studprograms()
    {
        return $this->belongsTo('App\Program','program_id');
    }

}
