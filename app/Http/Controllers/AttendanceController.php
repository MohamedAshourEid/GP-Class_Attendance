<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Lecture;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function generateQrCode(Request $req){
        $courseID = $req ->courseID;
        $type = $req ->type; // type = lec or lab
        $date = date('Y-m-d H:i:s');
        // generate unique id
        $ID = $date.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);

        // insert lec/lab into database
        if($type == 'Lab') {
            Lab::create([
                'course_id' => $courseID,
                'id' => $ID
            ]);
        }
        elseif ($type == 'Lec'){
            Lecture::create([
                'course_id' => $courseID,
                'id' => $ID
            ]);
        }
        // prepare the content of QrCode
        $qrContent = [
            'courseID' => $courseID,
            'type' => '$type',
            'ID' => $ID // lec\lab ID
        ];
        $str = json_encode($qrContent); // convert json into string

        /*
           encode the qrCondtent
         */

        return view('staff/QrCode',['qrContent' => $str]); // display the QrCode
    }

    public function scan($str){

        $someObject = json_decode($str);
        $lecID = $someObject->ID;

        return view('staff/QrCode',['qrContent' => $str,'item' => $lecID]);
    }

}
