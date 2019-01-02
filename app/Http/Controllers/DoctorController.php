<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller as BaseController;
class DoctorController extends Controller
{
    public function index()
    {
        $prescription = Prescription::all();
        return $prescription;
    }

    public function store(Request $request)
    {  
        
        $_date = substr($request->date, 0, -14);
       

        $prescription = new Prescription();
        $prescription->patient_id = $request->patient_id;
        $prescription->date = $_date;
        $prescription->drug_name = $request->drug_name;
        $prescription->quantity = $request->quantity;
       
        
        $prescription->save();

        

        return $prescription;
        return redirect('/doctor/enterprescription');
    }
}
