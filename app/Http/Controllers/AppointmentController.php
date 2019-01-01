<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
        return $appointments;
    }

    public function getCountStatus(){
        $count1=Appointment::where('timeslot','8-9')->count();
        $count2=Appointment::where('timeslot','9-10')->count();
        $count3=Appointment::where('timeslot','10-11')->count();
        $count4=Appointment::where('timeslot','11-12')->count();
        $status1= $this->getStatus($count1);
        $status2= $this->getStatus($count2);
        $status3= $this->getStatus($count3);
        $status4= $this->getStatus($count4);
        $count= array($count1,$status1,$count2,$status2,$count3,$status3,$count4,$status4);
        return $count;
    }

    public function getStatus($count){
        if($count>=20){
            $status="Full";
        }else{
            $status="Not Full";
        }
        return $status;
    }

    public function add(Request $request)
    {
        $_date = substr($request->date, 0, -14);

        $appointment = new Appointment();
        $appointment->date = $_date;
        $appointment->timeslot = $request->timeslot;
        $appointment->patient_id = $request->patient_id;
        $appointment->save();
        
        return $appointment;
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
        //
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

    public function getTodayList()
    {
        $appointment = Appointment::where('flag', 0)->get();
        return $appointment;
    }
}
