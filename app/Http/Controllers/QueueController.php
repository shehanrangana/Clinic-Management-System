<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queue1;
use App\Queue2;
use App\Queue3;
use App\Queue4;

class QueueController extends Controller
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
        if($request->timeslot == "08-09"){
            $queue = new Queue1(); 
        }else if($request->timeslot == "09-10"){
            $queue = new Queue2(); 
        }else if($request->timeslot == "10-11"){
            $queue = new Queue3(); 
        }else if($request->timeslot == "11-12"){
            $queue = new Queue4(); 
        }

        $queue->number = $request->number;
        $queue->patient_id = $request->patient_id;
        $queue->save();
        return $queue;
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

    // This method will return the recent number of a specific queue
    public function getRecentNumber(Request $request)
    {
        $recentNumber = -1;
        if($request->timeslot == "08-09"){
            if(!Queue1::all() -> isEmpty()){
                $recentNumber = Queue1::orderBy('number', 'desc')->first()->number;
            }
        }else if($request->timeslot == "09-10"){
            if(!Queue2::all() -> isEmpty()){
                $recentNumber = Queue2::orderBy('number', 'desc')->first()->number;
            }
        }else if($request->timeslot == "10-11"){
            if(!Queue3::all() -> isEmpty()){
                $recentNumber = Queue3::orderBy('number', 'desc')->first()->number;
            }
        }else if($request->timeslot == "11-12"){
            if(!Queue4::all() -> isEmpty()){
                $recentNumber = Queue4::orderBy('number', 'desc')->first()->number;
            }
        }
        return $recentNumber;
        
    }
}
