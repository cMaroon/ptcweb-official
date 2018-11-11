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
    
        $enrollment = Enrollment::with('enrollprograms')->where('enr_id_num', '=', $user_id_num)->latest()->paginate(15);

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
        // $curriculum = Curriculum::findOrFail($id);

        // // delete the user

        // $curriculum->delete();


    }
}
