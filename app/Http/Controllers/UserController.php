<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $user = User::all();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $flag = -1;

        if($request->user_role == "Admin"){
            $flag = 0;
        }else if($request->user_role == "Receptionist"){
            $flag = 1;
        }else if($request->user_role == "Doctor"){
            $flag = 2;
        }else if($request->user_role == "Nurse"){
            $flag = 3;
        }else if($request->user_role == "Lab Assistant"){
            $flag = 4;
        }else if($request->user_role == "Pharmacist"){
            $flag = 5;
        }

        $_birthday = substr($request->birthday, 0, -14);

        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->birthday = $_birthday;
        $user->email = $request->email;
        $user->password = "test";
        $user->contact_number = $request->contact_number;
        $user->user_role = $flag;
        $user->qualification = $request->qualification;
        $user->slmc_number = $request->slmc_number;
        $user->save();

        return $user;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $user = User::find($id)->delete();
    }
}
