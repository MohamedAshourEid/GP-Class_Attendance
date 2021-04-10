<?php


namespace App\Http\Controllers\attendance;

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
    /*Here i get the attendance of specific session*/
    public function getAttendanceOfSession($sessionID){
        return json_encode(Attendance::query()->join('students','students.student_id'
            ,'=','attendence.student_id')
            ->select('students.Fname','students.Lname','students.student_id')
            ->where('attendence.session_id','=',$sessionID)
            ->get());
    }



}
