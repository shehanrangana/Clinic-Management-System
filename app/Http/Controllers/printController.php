<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controllers;
use App\File;

class printController extends Controller
{
	public function index(){
		return view('viewPrint');
	}
    public function printPreview(){
    	$File = files::all();
    	return view('printPreview' , compact('File'));

    }
}
