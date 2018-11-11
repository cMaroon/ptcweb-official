<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Program;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        // $program = Program::all();
        // || \Gate::allows('isAuthor')
        // if (\Gate::allows('isSuperAdmin')) {
            return Program::latest()->paginate(15);
        // }
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'program_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
        ]);
        return Program::create([
            'program_code' => $request['program_code'],
            'descriptive_title' => $request['descriptive_title'],
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
        $program = Program::findOrFail($id);
        

        $this->validate($request,[
            'program_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
        ]);

        $program->update($request->all());
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
        $program = Program::findOrFail($id);

        // delete the user

        $program->delete();


        // return ['message'=>'Program Deleted!'];
    }


}
