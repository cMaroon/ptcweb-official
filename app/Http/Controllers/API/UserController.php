<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_num' => ['required', 'string', 'max:191'],
            'firstname' => ['required', 'string', 'max:191', 'alpha_spaces'],
            'middlename' => ['max:191', 'alpha_spaces','nullable'],
            'lastname' => ['required', 'string', 'max:191', 'alpha_spaces'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        return User::create([
            'id_num' => $request['id_num'],
            'firstname' => $request['firstname'],
            'middlename' => $request['middlename'],
            'lastname' => $request['lastname'],
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
