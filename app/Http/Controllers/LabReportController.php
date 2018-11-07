<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabReport;
//use Illuminate\Support\Facades\Input;
//use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller as BaseController;
class LabReportController extends BaseController
{
   public function index()
    {
        $report = LabReport::all();
        return $report;
    }

    public function store(Request $request)
    {  
        

        //$file = Input::get('file');

            // $filename = $request->file('file')->getClientOriginalName();
            // $request->file(key:'file')->getClientOriginalExtension();
            // $request->file(key:'file')->move(directory:base_path().'/public/uploads' , $filename);

            // return $filename;
            // $request->file->move($filename, '/lab_reports');

            // $file = new LabReport;
            
            // $file->patient_nic = $request->patient_id;
            // $file->test = $request->test;
            // $file->file =  $filename;
            // $file->save();

            // $filename = $file->report_id.'.'.
           
            // $file->file = $filename;

        // $request->validate([
            // 'file' => 'requ'])

        $file = new LabReport;
        $file->patient_id = $request->patient_id;
        $file->test = $request->test;
        $file->file =  $request->file('file')->store('/uploads', 'public');
        $file->save();

        return $file;




            return redirect('/lab');

       
    }

 
}
