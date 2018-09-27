<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Reequest;
use DB;


class DownloadController extends Controller
{
    public function download(){
    	$download = DB::table('files')->get();
    	return view('download.viewfile' ,compact('download'));
    }
}
