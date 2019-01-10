<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\Prescription;
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
    public function prescription()
    {
        
        $prescription = Prescription::where('date', date("Y-m-d"))->get();
        return $prescription;
        // dd($prescription);
    }
    public function overDrug()
    {
        
        $overDrug = DB::table('drugs')->select('name', 'brand' ,'supplier_email')->where('quantity', '<','950')->get();
        return $overDrug;
        
        
    }
    public function expireDrug()
    {
        
        
        $expireDrug = DB::table('drugs')->select('name', 'brand' ,'quantity','supplier_email')->where('expire_date', '<=',date("Y-m-d"))->get();
        return $expireDrug;
        
        
    }

    
    public function reduseQuantity(Request $request){
        $old = DB::table('drugs')->where('name',$request->drug_name)->first();
        $new = $old->quantity - $request->quantity;
        //if($new>0){
        DB::table('drugs')->where('name',$request->drug_name)->update(['quantity'=>$new]);
        $a=$request->drug_name;
        //}else{
            //alert('Can not issue, Insuffisent drugs');
            //return 0;
        //}
        if($new<=950){
            // return view('pharmacy/View_Prescription',compact('a','new'));
            return true;
        }
    }

    public function update(Request $request){
        $_expiredate = substr($request->expire_date, 0, -14);
       DB::table('drugs')->where('drug_id',$request->drug_id)->update(['quantity'=>$request->quantity ,'expire_date'=>$_expiredate]); 
       
    }

    public function store(Request $request)
    {  
        
        $_expiredate = substr($request->expire_date, 0, -14);
       

        $drug = new Drug();
        $drug->name = $request->name;
        $drug->brand = $request->brand;
        $drug->quantity = $request->quantity;
        $drug->expire_date = $_expiredate;
        $drug->supplier_email = $request->supplier_email;
        
        $drug->save();  
        return $drug;
        return redirect('/pharmacy/addingdrugs');
    }
    public function destroy($id)
    {
        $drugs = Drug::find($id)->delete();
    }
    
    

}
