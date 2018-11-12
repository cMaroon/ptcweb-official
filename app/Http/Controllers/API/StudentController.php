<?php

namespace App\Http\Controllers\API;

// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Student;
use App\Program;
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
    

        // $student = Student::on('mysql2'); // Connects to ptcweb_students_db

        // $student = Student::select('student_type')->where('id_num', '=', $user_id_num)->first();
        $student = Student::with('studprograms','studyearlevel','studsection')->where('id_num', '=', $user_id_num)->first();
        // dd($student);

        return $student;
    }

    public function StudentList()
    {
        if (\Gate::allows('isSuperAdmin')) {
            
            $studentlist = Student::with('studprograms','studyearlevel','studsection')->latest()->paginate(10);

            // dd($studentlist);
            return $studentlist;
        }

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
    }

    public function destroy($id)
    {
        //
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $studentlist = Student::with('studprograms','studyearlevel','studsection')->where(function($query) use ($search){
                $query->where('id_num','LIKE',"%$search%")
                        ->orWhere('firstname','LIKE',"%$search%")
                        ->orWhere('lastname','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $studentlist = Student::with('studprograms','studyearlevel','studsection')->latest()->paginate(10);            
        }

        return $studentlist;

    }

    
}
