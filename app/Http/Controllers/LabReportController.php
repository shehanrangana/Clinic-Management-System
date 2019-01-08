<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabReport;
// use Illuminate\Support\Facades\Input;
// use Input;
use App\Patient;
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
    public function getReport(Request $request) 
    {
    
        $roles = DB::table('lab_reports')->where('report_id','file')->get();
        
        return $roles;
        dd($request->all());

    }
    
    // public function destroy($id)
    // {
    //     $lab_reports = LabReport::find($id)->delete();
    // }

    //check the patient id exits in the patient table
    public function checkID(Request $request){
        // dd($request->all());
        $patients=Patient::where('patient_id',$request->patient_id)->exists();
        if($patients){
            return 1;
        }else{
            return 0;
        }
    }


 
}
