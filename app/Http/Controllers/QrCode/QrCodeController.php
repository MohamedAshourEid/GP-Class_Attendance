<?php

namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;


class QrCodeController extends Controller
{
    public function generateQrCode(Request $request){

        $date = date('Y-m-d H:i:s');
        // generate unique id
        $sessionID = $date.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);


        $this->InsertInDatabase($request,$sessionID);
        // prepare the content of QrCode
        $qrContent = [
            'courseID' => $request->courseID,
            'sessionID' => $sessionID
        ];
        $str = json_encode($qrContent); // convert json into string

        /*
           encode the qrCondtent
         */
        print_r($str);
        return view('staff/QrCode',['qrContent' => $str]); // display the QrCode
    }

    public function scan($str){

        $someObject = json_decode($str);
        $lecID = $someObject->ID;

        return view('staff/QrCode',['qrContent' => $str,'item' => $lecID]);
    }
    public function InsertInDatabase($request,$sessionID){

        Session::create([
            'course_id'=>$request->courseID,
            'instructor_id'=>$request->instructorID,
            'session_id'=>$sessionID
        ]);

    }
}
