<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Courses;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        $courses = Courses::all();
        // || \Gate::allows('isAuthor')
        if (\Gate::allows('isSuperAdmin')) {
            return Courses::latest()->paginate(15);
        }
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'course_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
            'lec_hr' => 'required',
            'lab_hr' => 'required',
            'course_unit' => 'required',
        ]);
        return Courses::create([
            'course_code' => $request['course_code'],
            'descriptive_title' => $request['descriptive_title'],
            'lec_hr' => $request['lec_hr'],
            'lab_hr' => $request['lab_hr'],
            'course_unit' => $request['course_unit'],
            'course_pre_req' => $request['course_pre_req'],
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
        $courses = Courses::findOrFail($id);
        

        $this->validate($request,[
            'course_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
            'lec_hr' => 'required',
            'lab_hr' => 'required',
            'course_unit' => 'required',
        ]);

        $courses->update($request->all());
        return ['message'=>'Updated the program info'];
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
        $courses = Courses::findOrFail($id);

        // delete the user

        $courses->delete();


        return ['message'=>'Courses Deleted!'];
    }
}
