<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Curriculum;

class CurriculumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        // $curriculum = Curriculum::with('currprograms','currcourses','currsemester','curryearlevel')->get();
        // || \Gate::allows('isAuthor')
        // if (\Gate::allows('isSuperAdmin')) {
            // dd($curriculum);
            return Curriculum::with('currprograms','currcourses','currsemester','curryearlevel')->latest()->paginate(15);
        // }
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'semester' => 'required',
            'curr_year' => 'required',
            'curr_program_id' => 'required',
            'curr_course_id' => 'required',

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
            'semester' => 'required',
            'curr_year' => 'required',
            'curr_program_id' => 'required',
            'curr_course_id' => 'required',
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
