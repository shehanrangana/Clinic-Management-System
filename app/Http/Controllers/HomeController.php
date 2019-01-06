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
        //$this->EmailChecker = new EmailChecker;
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
        //$supplier_email = $request->supplier_email;
        $supplier_email = 'asangisathsarani@gmail.com';
        $msg = "Dear".$name." ".$quantity." ".$brand." ".$date;
        $data = array('msg'=>$msg);
        //Mail::send('mail/reminder',$data ,function($massege) use($supplier_email){
        Mail::send('mail/reminder',$data ,function($massege) use($supplier_email){
            $massege->to($supplier_email)->subject('Suwasetha Pharmacy');
            $massege->from('asangiucsc1995@gmail.com','Suwetha Pharmacy');

        });
    
    }
}
