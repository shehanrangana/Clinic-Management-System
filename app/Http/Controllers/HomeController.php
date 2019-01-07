<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Reminder;
use App\Drug;
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
        $supplier_email = $request->supplier_email;
        $msg =  "Please Supplie This Drugs."."   "."Drug name :".$name."  "."Drug Brand:".$brand."   "."Drug Quantity:".$quantity."   "."Please suplie before that date ".$date."  "."Thank you"

        //$msg = "Dear ".$name." ".$quantity." ".$brand." ".$date;
        
        $data = array('msg'=>$msg);
        
        Mail::send('mail/reminder',$data ,function($massege) use($supplier_email){
            $massege->to($supplier_email)->subject('Suwasetha Pharmacy');
            $massege->from('asangiucsc1995@gmail.com','Suwetha Pharmacy');

        });
    
    }

    //check the suppiler email exits in the drugs table
    public function checkEmail(Request $request){
        // dd($request->all());
        $supplier_email=Drugs::where('supplier_email',$request->supplier_email)->exists();
        if($supplier_email){
            return 1;
        }else{
            return 0;
        }
    }

}
