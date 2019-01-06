<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\Patient;
use App\Prescription;
use App\DoctorSession;
use App\QueueSummary;

class PatientController extends Controller
{
    // public function __construct()
    // {   
    //     $this->middleware('auth', ['except' => 'recept/patients']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return $patients;
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
        $_birthday = substr($request->birthday, 0, -14);

        $patient = new Patient();
        $patient->patient_id = $request->patient_id;
        $patient->name = $request->name;
        $patient->address_line_1 = $request->address_line_1;
        $patient->address_line_2 = $request->address_line_2;
        $patient->address_line_3 = $request->address_line_3;
        $patient->nic = $request->nic;
        $patient->gender = $request->gender;
        $patient->birthday = $_birthday;
        $patient->contact_number = $request->contact_number;
        $patient->guardian_number = $request->guardian_number;
        $patient->save();

        return $patient;
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
    public function destroy($patient_id)
    {
        $patient = Patient::find($patient_id)->delete();
    }

    // Search patients for queue
    public function search()
    {
        $query = Input::get('query');
        $users = Patient::where('name','like','%'.$query.'%')->get();
        return response()->json($users);
    }

    // Filter table
    public function filter(Request $request)
    {
        dd($request->all());
        // $search = $request->search;
        // $patient = Patient::where('name', 'LIKE', "%$search%");

        // return response()->json([
        //     'model'=>$patient
        // ]);
    }

    // Get patient id of the last registered
    public function getLastId() 
    {
        if(!Patient::all() -> isEmpty()){
            $recentId = Patient::orderBy('patient_id', 'desc')->first()->patient_id;
            return $recentId;
        }
    }

    // Get patient medical history
    public function getPatientHistory(Request $request)
    {
        // Get particular patient's medical history
        $categorizedArray = array();
        $patientHistory = Prescription::where('patient_id', $request->patient_id)->orderBy('date', 'desc')->get()->groupBy('date');
        foreach ($patientHistory as $oneDay) {
            array_push($categorizedArray, $oneDay);
        }
        // Get relevant panel number using session id of logged doctor
        $panel = DoctorSession::where('session', Session::getId())->get()->first()->panel;
        // dd($panel);

        // Update queue_summary table 
        DB::table('queue_summary')->where('status', 1)->update(['current'=> $request->number, $panel=> $request->number]);
        
        // Get current number of overall progress
        $currentNumber = QueueSummary::where('status', 1)->select('current')->get()->first();
        // dd($currentNumber->current+1);

        return ['patient_history'=>$categorizedArray, 'next_number'=> $currentNumber->current+1];
    }
}
