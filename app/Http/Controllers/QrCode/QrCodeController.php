<?php

namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\attendance\AttendanceController;

class QrCodeController extends Controller
{
    public static function showQrCode(Request $request,$sessionID){

        // prepare the content of QrCode
        $qrContent = [
            'courseID' => $request->courseID,
            'sessionID' => $sessionID
        ];
        $str = json_encode($qrContent); // convert json into string

        /*
           encode the qrCondtent
         */

        return view('staff/QrCode',['qrContent' => $str]); // display the QrCode
    }

    public function scan($content,$studentID){

        $QrContent = json_decode($content);
        return AttendanceController::addAttendence($QrContent,$studentID);

    }

}
