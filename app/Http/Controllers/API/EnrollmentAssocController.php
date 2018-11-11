<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\EnrollmentAssoc;
use Auth;


class EnrollmentAssocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function show($id)
    {
        // $user_id_num = Auth::user()->id_num;
        // dd($user_id_num);

    
        $enrollmentassoc = EnrollmentAssoc::with('assocformid','assoccurrid')->where('assoc_form_id','=',$id)->latest()->paginate(15);
        // $enrollmentassoc = EnrollmentAssoc::findOrFail($id);
        // dd($enrollmentassoc);

        return $enrollmentassoc;
        
    }

  

    // public function student(){
    //     return Auth('api')->user(); 

    //  }

    public function store(Request $request)
    {

        return EnrollmentAssoc::create([
            'semester' => $request['semester'],
            'enr_year' => $request['enr_year'],
            'assoc_form_id' => $request['assoc_form_id'],
            'assoc_curr_id' => $request['assoc_curr_id'],
            'assoc_course_id' => $request['assoc_course_id'],
            'assoc_prof_id' => $request['assoc_final_grade'],
            'advising_status' => $request['advising_status'],
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
