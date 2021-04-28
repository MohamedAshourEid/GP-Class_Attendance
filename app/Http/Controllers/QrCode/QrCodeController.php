<?php
/*
 * Author : Alaa Ibrahim
 */
namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\attendance\AttendanceController;

class QrCodeController extends Controller
{
    /*this function take request and sessionID
    after the sessionController create the session this function show the Qr code*/
    public static function showQrCode(Request $request,$sessionID){

        $qrContent = [
            'courseID' => $request->courseID,
            'sessionID' => $sessionID
        ];
        $str = json_encode($qrContent); // convert json into string
        return view('staff/QrCode',['qrContent' => $str]); // display the QrCode
    }
    /*after the student scan the Qr Code
    he will registered in the attendance using the attendanceController*/
    public function scan($content,$studentID){

        $QrContent = json_decode($content);
        return AttendanceController::addAttendence($QrContent,$studentID);

    }

}
