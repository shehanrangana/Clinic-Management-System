<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;


class AppointmentController extends Controller
{
    public function add(Request $request)
    {
        $_date = substr($request->date, 0, -14);

        $appointment = new Appointment();
        $appointment->date = $_date;
        $appointment->timeslot = $request->timeslot;
        $appointment->patient_nic = $request->nic;
        $appointment->save();

        return $appointment;
    }
}
