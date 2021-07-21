<?php
namespace App\Http\Controllers\Reports;
session()->start();

use App\Http\Controllers\K_Means\KmeansController;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teach;
use App\Models\Enrolled_Courses;
use App\Models\Announcement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\requestTrait;

class TopFive extends Controller
{

    public function getTopFive(Request $request)
    {
        $studentIDs=Student::query()->select('student_id','Fname','Lname')
            ->get();
        $attendanceData=Attendance::query()->select('student_id','attended')->where('course_id','=',"$request->courseID")
            ->get();
        $studentsattend=[];
        $studentnames=[];
        foreach ($studentIDs as $id)
        {

            $SID="";
            $attendance=0;
            $sessions=[];
            $Sname="";
            foreach ($attendanceData as $Data)
            {

                if($id->student_id==$Data->student_id)
                {
                    $sessions[]=(int)$Data->attended;
                    $attendance=$attendance+(int)$Data->attended;
                    $SID=$Data->student_id;
                    $Sname=$id->Fname.' '.$id->Lname;


                }
            }
            if($SID!=""&&$attendance==sizeof($sessions))
                $studentsattend[]=$SID;
                $studentnames[]=$Sname;
        }
        return view('staff/getreport',['regularstudents'=>$studentsattend,'studentnames'=>$studentnames]) ;
    }












}
