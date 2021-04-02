<?php


namespace App\Http\Controllers\attendanceController;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    public static function addAttendence($QrContent,$studentID){

        if(Attendance::create(['course_id'=>$QrContent->courseID, 'student_id'=>$studentID, 'session_id'=>$QrContent->sessionID]))
        {
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }



}
