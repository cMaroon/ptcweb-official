<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\EnrollmentAssoc;
use App\Enrollment;
use Auth;


class CurriculumAssocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
    
        // $enrollmentassoc = EnrollmentAssoc::with('assocformid.studinfo.studprograms.advisingid','assocformid.studinfo.studsection','assocformid.studinfo.studyearlevel','assoccurrid.curryearlevel','assoccurrid.currsemester','assoccurrid.currcourses','assoccurrid.currprograms','assoccurrid.currsection')->latest()->paginate(15);

        // return $enrollmentassoc;
        
    }
    
    public function show($id)
    {


    
        $enrollmentassoc = EnrollmentAssoc::with('assocformid.studinfo.studprograms.advisingid','assocformid.studinfo.studsection','assocformid.studinfo.studyearlevel','assoccurrid.curryearlevel','assoccurrid.currsemester','assoccurrid.currcourses','assoccurrid.currprograms','assoccurrid.currsection')->where('assoc_curr_id','=',$id)->latest()->paginate(100);


        return $enrollmentassoc;
        
    }
    // public function student(){
    //     return Auth('api')->user(); 

    //  }


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
        $enrollmentassoc = EnrollmentAssoc::findOrFail($id);

        // delete the user

        $enrollmentassoc->delete();


    }

    public function search(){

    

    }
}
