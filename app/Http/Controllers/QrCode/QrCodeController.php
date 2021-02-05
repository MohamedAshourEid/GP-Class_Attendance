<?php

namespace App\Http\Controllers\QrCode;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Lab;
use App\Models\Lecture;
use App\Models\Session;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function generateQrCode(Request $req){
        $courseID = $req ->courseID;
        $date = date('Y-m-d H:i:s');
        // generate unique id
        $sessionID = $date.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);

        // insert lec/lab into database
        Session::create([
            'session_id' => $sessionID,
            'course_id' => $courseID,
            'instructor_id' => '123'
        ]);
        // prepare the content of QrCode
        $qrContent = [
            'courseID' => $courseID,
            '$sessionID' => $sessionID // lec\lab ID
        ];

        $str = json_encode($qrContent); // convert json into string

        /*
         * encode the qrCondtent
         */

        return view('staff/QrCode',['qrContent' => $str]); // display the QrCode
    }

    public function recieveQrContent(Request $req){
        $str = $req -> str;
        // convert str into json
        $qrContent = json_decode($str);

        /*
         * check the time of scannig first
         */

        Attendance::create([
            'student_id' => "20170239",
            'session_id' => $qrContent->session_id,
            'instructor_id' => "123"
        ]);
    }
}
