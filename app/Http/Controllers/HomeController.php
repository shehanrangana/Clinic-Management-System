<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Reminder;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->EmailChecker = new EmailChecker;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function testMail(Request $request){
        $name =  $request->name;
        $quantity = $request->quantity;
        $brand = $request->brand;
        $date = $request->date;
        $supplier_email = $request->supplier_email;
        $msg = "asdfsdgf";
        $mail = 'asangisathsarani@gmail.com';
        Mail::to($mail)->send(new Reminder);;
        dd('Mail send succesfuly!');
    }
}
