<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Student;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        // $student = Student::on('mysql2');
        $student = Student::all();
        // || \Gate::allows('isAuthor')
        if (\Gate::allows('isSuperAdmin')) {
            return User::latest()->paginate(10);
        }
        
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'id_num' => 'required|string|max:191|unique:users',
            'firstname' => 'required|string|max:191|alpha_spaces',
            'middlename' => 'max:191|alpha_spaces|nullable',
            'lastname' => 'required|string|max:191|alpha_spaces',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);
        return User::create([
            'id_num' => $request['id_num'],
            // 'name'=> $data['firstname'].' '.$data['middlename'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'usertype' => $request['usertype'],
        ]);



        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::findOrFail($id);
        

        $this->validate($request,[
            'id_num' => 'required|string|max:191|unique:users,id_num,'.$user->id,
            'firstname' => 'required|string|max:191|alpha_spaces',
            'middlename' => 'max:191|alpha_spaces|nullable',
            'lastname' => 'required|string|max:191|alpha_spaces',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6',
        ]);

        $user->update($request->all());
        return ['message'=>'Updated the user info'];
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
        $user = User::findOrFail($id);

        // delete the user

        $user->delete();


        return ['message'=>'User Deleted!'];
    }
}
