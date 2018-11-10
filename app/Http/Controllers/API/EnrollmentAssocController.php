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
    
    public function index()
    {
        // $user_id_num = Auth::user()->id_num;
        // dd($user_id_num);
    
        $enrollmentassoc = EnrollmentAssoc::latest()->paginate(15);

        return $enrollmentassoc;
        
    }

    // public function student(){
    //     return Auth('api')->user(); 

    //  }

    public function store(Request $request)
    {
        $this->validate($request,[
            'semester' => 'required|string|max:191',
            'curr_year' => 'required|max:191',
            'curr_program_id' => 'required|max:191',
            'curr_course_id' => 'required|max:191',

        ]);
        return Curriculum::create([
            'semester' => $request['semester'],
            'curr_year' => $request['curr_year'],
            'curr_program_id' => $request['curr_program_id'],
            'curr_course_id' => $request['curr_course_id'],
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
        $curriculum = Curriculum::findOrFail($id);
        

        $this->validate($request,[
            'semester' => 'required|string|max:191',
            'curr_year' => 'required|max:191',
            'curr_program_id' => 'required|max:191',
            'curr_course_id' => 'required|max:191',
        ]);

        $curriculum->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isSuperAdmin');
        $curriculum = Curriculum::findOrFail($id);

        // delete the user

        $curriculum->delete();


    }
}
