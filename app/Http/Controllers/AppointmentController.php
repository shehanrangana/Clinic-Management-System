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
    //get no of apointments for specific date
    public function getCountStatus($date){
        $count1=Appointment::where('date',$date)->where('timeslot','08-09')->count();
        $count2=Appointment::where('date',$date)->where('timeslot','09-10')->count();
        $count3=Appointment::where('date',$date)->where('timeslot','10-11')->count();
        $count4=Appointment::where('date',$date)->where('timeslot','11-12')->count();
        
        $count= array('_0809'=>$count1,'_0910'=>$count2,'_1011'=>$count3,'_1112'=>$count4);
        
        return $count;
    }

    //add appointment to the appointment table
    public function add(Request $request){
         
        $appointment = new Appointment();
        
        $appointment->date = $request->date;
        $appointment->timeslot = $request->timeslot;
        $appointment->patient_id = $request->patient_id;
        $appointment->save();
        // dd($appointment);
        
        return $appointment;
    }

    
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

    //check availability of a appointment
    public function checkAppointment(Request $request){
        //dd($request->all());
        $appointment=Appointment::where('date',$request->date)->where('patient_id',$request->patient_id)->exists();
        if($appointment){
            return 0; //already have appointment
        }else{
            return 1;
        }
    }

    //get appointments with the patient id according to date and timeslot
    public function show(Request $request){
        //dd($request->all());
        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->select('appointments.patient_id', 'patients.name','appointments.date','appointments.timeslot')
            ->where('appointments.date',$request->date)
            ->where('appointments.timeslot',$request->timeslot)
            ->get();
        return $appointments;
    }
    
    //get appointment with the patient id according to the date
    public function showForDate(Request $request){
        //dd($request->all());
        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->select('appointments.patient_id', 'patients.name','appointments.date','appointments.timeslot')
            ->where('appointments.date',$request->date)
            ->get();
        return $appointments;
    }

    //delete appointment
    public function destroy(Request $request)
    {
        //dd($request->all());
        DB::table('appointments')->where('date', $request->date)->where('patient_id',$request->patient_id)->delete();
    }

    public function getTodayList()
    {
        date_default_timezone_set("Asia/Colombo");
        $appointment = Appointment::where('flag', 0)->where('date', date('Y-m-d'))->get();
        return $appointment;
    }
}
