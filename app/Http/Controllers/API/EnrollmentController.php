<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Enrollment;
use Auth;


class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        $user_id_num = Auth::user()->id_num;
        // dd($user_id_num);
    
        $enrollment = Enrollment::with('enrollprograms','studinfo.studsection')->where('enr_id_num', '=', $user_id_num)->latest()->paginate(15);
        

        return $enrollment;
        
    }

    // public function student(){
    //     return Auth('api')->user(); 

    //  }

    public function store(Request $request)
    {

        return Enrollment::create([
            'enr_form_id' => $request['enr_form_id'],
            'enr_id_num' => $request['enr_id_num'],
            'enr_program_id' => $request['enr_program_id'],
        ]);


    }

    public function EnrollList()
    {
        if (\Gate::allows('isSuperAdmin')) {
            
            $enroll = Enrollment::with('enrollassoc','enrollprograms','studinfo.studsection')->latest()->paginate(10);

            // dd($studentlist);
            return $enroll;
        }

    }


    public function EnrollAll()
    {
        if (\Gate::allows('isSuperAdmin')) {
            
            $enroll = Enrollment::with('enrollprograms','studinfo.studsection')->get();

            // dd($studentlist);
            return $enroll;
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $curriculum = Curriculum::findOrFail($id);
        

        // $this->validate($request,[
        //     'semester' => 'required|string|max:191',
        //     'curr_year' => 'required|max:191',
        //     'curr_program_id' => 'required|max:191',
        //     'curr_course_id' => 'required|max:191',
        // ]);

        // $curriculum->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isSuperAdmin');
        $enrollment = Enrollment::findOrFail($id);

        // delete the user

        $enrollment->delete();


    }

    public function searchID(){

        if ($search = \Request::get('q')) {
            $enrollment = Enrollment::with('enrollprograms','studinfo.studsection')->where(function($query) use ($search){
                $query->where('enr_id_num','LIKE',"%$search%")
                        ->orWhere('enr_form_id','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $enrollment = Enrollment::with('enrollprograms','studinfo.studsection')->latest()->paginate(10);            
        }

        return $enrollment;

    }
}
