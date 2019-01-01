<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Mail\Password;
use Hash;
use Session;

class UserController extends Controller
{
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            session(['user' => $this->user->user_id]); // set current user id as a session variable
            return $next($request);
        });
    }

    public function admin()
    {
        return view('./admin/dashboard');
    }

    public function receptionist()
    {
        return view('./recept/dashboard');
    }

    public function doctor()
    {
        return view('./doctor/dashboard');
    }

    public function nurse()
    {
        return view('./nurse/dashboard');
    }

    public function lab_assistant()
    {
        return view('./lab/dashboard');
    }

    public function pharmacist()
    {
        return view('./pharmacy/dashboard');
    }

    // Retrieve logged user data
    public function loadProfile($id)
    {   
        $user = User::where('user_id', $id)->get(); 
        return view('./profile')->with('user', $user);
    }

    // Update user profile
    public function updateProfile(Request $request) 
    {
        return DB::table('users')->where('user_id', $request[0])
        ->update(['email'=> $request[1], 'contact_number' => $request[2], 'qualification'=> $request[3]]);
    }

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
        $random_password = str_random(8);; // Generate random password

        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->birthday = $_birthday;
        $user->email = $request->email;
        $user->password = Hash::make($random_password);
        $user->contact_number = $request->contact_number;
        $user->user_role = $flag;
        $user->qualification = $request->qualification;
        $user->slmc_number = $request->slmc_number;
        $user->save();

        // Sent password to registered user by an email
        \Mail::to($user)->send(new Password($user, $random_password));

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
