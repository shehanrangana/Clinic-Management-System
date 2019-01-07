<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Prescription;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $patient_id = $request[0];
        $recentComment = $request[2];
        $isFirstTime = true;
        $recentPrescription = array();
        foreach ($request[1] as $drug) {
            if(!empty($drug['drug'])){ // insert into prescription if $drug is not null
                $prescription = new Prescription();
                $prescription->patient_id = $patient_id;
                $prescription->date = date('Y-m-d'); // set current date
                $prescription->drug_name = $drug['drug'];
                $prescription->quantity = $drug['quantity'];
                $prescription->unit = $drug['isLiquid'];
                $prescription->save();
                array_push($recentPrescription, $prescription);
            }
            // This execute only first time
            if($isFirstTime) {
                // Store comments
                DB::table('prescriptions')->where('patient_id', $patient_id)->where('date', date('Y-m-d'))->update(['comments' => $request[2]]); 
            }
            $isFirstTime = false;
        }

        // Set 'checked' to 1 in queue tables[notify patient is checked]
        $queue_table;
        switch ($request[3]) {
            case '08-09':
                $queue_table = 'queue1';
                break;  
            case '09-10':
                $queue_table = 'queue2';
                break;
            case '10-11':
                $queue_table = 'queue3';
                break;
            case '11-12':
                $queue_table = 'queue4';
                break;
        }
        DB::table($queue_table)->where('patient_id', $patient_id)->update(['checked' => true]); 
        // return ['recentPrescription'=>$recentPrescription, 'comment'=>$recentComment];
        return $recentPrescription;
        
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
        //
    }
}
