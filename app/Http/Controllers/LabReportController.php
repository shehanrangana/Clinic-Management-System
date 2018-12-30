<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabReport;
//use Illuminate\Support\Facades\Input;
//use Input;
use DB;
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
        

        


        $file = new LabReport;
        $file->patient_id = $request->patient_id;
        $file->test = $request->test;
        $file->file =  $request->file('file')->store('/uploads', 'public');
        $file->save();

        return $file;




            return redirect('/lab');

       
    }
    public function getReport() 
    {
    
        $roles = DB::table('lab_reports')->pluck('patient_id' ,'file');

        return $roles;

    }

 
}
