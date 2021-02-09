<?php


namespace App\Http\Controllers\ApiAttendance;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    public function attendLecture(Request $request){

        $QrContent=$request->qrContent;
        $newRequest = json_decode($QrContent);
         /*return ['courseID'=>$newRequest->courseID,
             'sessionID'=>$newRequest->sessionID,
             'studentID'=>$request->studentID
         ];*/

        return $this->addAttendence($newRequest,$request);


    }

    public function addAttendence($newReq,$requset){

        if(Attendance::create(['course_id'=>$newReq->courseID, 'student_id'=>$requset->studentID, 'session_id'=>$newReq->sessionID]))
        {
            return ['success'=>'Your attendence registered successfully'];
        }
    }



}
