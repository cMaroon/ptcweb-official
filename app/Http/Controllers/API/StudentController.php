<?php

namespace App\Http\Controllers\API;

// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Auth;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {

        $user_id_num = Auth::user()->id_num;

        $student = Student::on('mysql2'); // Connects to ptcweb_students_db

        // $student = Student::select('student_type')->where('id_num', '=', $user_id_num)->first();
        $student = Student::where('id_num', '=', $user_id_num)->first();


        return $student;
    }

    public function store(Request $request)
    {
        return Student::create([
            'id_num' => $request['id_num'],
            ]);
    }

    public function student(){
        return Auth('api')->user(); 

     }

     public function getUser(Request $request){
        return json_encode($request->user());
     }

    public function show($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return ['message'=>'Updated the student info'];
    }

    public function destroy($id)
    {
        //
    }

    
}
