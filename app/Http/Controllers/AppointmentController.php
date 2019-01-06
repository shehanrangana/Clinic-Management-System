<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Patient;
use Illuminate\Support\Facades\DB;

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

    public function getCountStatus($date){
        $count1=Appointment::where('date',$date)->where('timeslot','08-09')->count();
        $count2=Appointment::where('date',$date)->where('timeslot','09-10')->count();
        $count3=Appointment::where('date',$date)->where('timeslot','10-11')->count();
        $count4=Appointment::where('date',$date)->where('timeslot','11-12')->count();
        // $status1= $this->getStatus($count1);
        // $status2= $this->getStatus($count2);
        // $status3= $this->getStatus($count3);
        // $status4= $this->getStatus($count4);
        $count= array('_0809'=>$count1,'_0910'=>$count2,'_1011'=>$count3,'_1112'=>$count4);
        //$count= array($count1,$status1,$count2,$status2,$count3,$status3,$count4,$status4);
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

    public function getCount(Request $request){
        //dd($request->all());
        $count=Appointment::where('date',$request->date)->where('timeslot',$request->timeslot)->count();
        return $count;
    }

    public function checkID(Request $request){
        // dd($request->all());
        $patients=Patient::where('patient_id',$request->patient_id)->exists();
        if($patients){
            return 1;
        }else{
            return 0;
        }
    }

    public function checkAppointment(Request $request){
        //dd($request->all());
        $appointment=Appointment::where('date',$request->date)->where('patient_id',$request->patient_id)->exists();
        if($appointment){
            return 0; //already added appointment
        }else{
            return 1;
        }
    }

    public function add(Request $request)
    {
        //$_date = substr($request->date, 0, -14);

        $appointment = new Appointment();
        //$appointment->date = $_date;
        $appointment->date = $request->date;
        $appointment->timeslot = $request->timeslot;
        $appointment->patient_id = $request->patient_id;
        $appointment->save();
        // dd($appointment);
        
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
    public function show(Request $request)
    {
        //dd($request->all());
        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->select('appointments.patient_id', 'patients.name','appointments.date','appointments.timeslot')
            ->where('appointments.date',$request->date)
            ->where('appointments.timeslot',$request->timeslot)
            ->get();
        return $appointments;
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
    public function destroy(Request $request)
    {
        dd($request->all());
        //DB::table('appointments')->where('date', $request->date)->where('pateint_id',$request->patient_id)->delete();
    }

    public function getTodayList()
    {
        $appointment = Appointment::where('flag', 0)->get();
        return $appointment;
    }
}
