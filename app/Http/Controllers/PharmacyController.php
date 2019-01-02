<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller as BaseController;
class PharmacyController extends Controller
{
    
	public function index()
    {
        $drugs = Drug::all();
        return $drugs;
    }

    public function store(Request $request)
    {  
        
        $_expiredate = substr($request->expire_date, 0, -14);
       

        $drug = new Drug();
        $drug->drug_name = $request->drug_name;
        $drug->brand = $request->brand;
        $drug->quantity = $request->quantity;
        $drug->expire_date = $_expiredate;
        $drug->supplier_email = $request->supplier_email;
        
        $drug->save();

        

        return $drug;
        return redirect('/pharmacy/addingdrugs');
    }


}
