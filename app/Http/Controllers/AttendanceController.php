<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function newLec(Request $req){
        $courseID = $req->courseID;
        // database part to add courseID and lecID into lecture table
        $lecID = "lecID33"; // get it from database
        return view('staff/QrCode',['id' => $lecID]);
    }
}
