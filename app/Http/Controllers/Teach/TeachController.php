<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use App\Models\Enrolled_Courses;
use Illuminate\Http\Request;
use App\Models\Teach;
class TeachController extends Controller
{
    //
    public function getTeachedCourses(){
        $instructorID = session('instructorID');
        $courses = TeachController::getInstructorCourses($instructorID);
        //echo $courses;
        //return $instructorID;
        return view("staff/Courses",['courses' => $courses]);
    }
    /*get all courses that instructor teach it*/
    public static function getInstructorCourses($instructorID){
        $result=Teach::query()->join('courses','teach.course_id','=',
            'courses.course_id')
            ->select('courses.name','courses.course_id')
            ->where('teach.instructor_id',
                '=',$instructorID)
            ->get();
        if(!$result->isEmpty())
            return $result;
    }
    public static function getInstructorCoursesApi(Request $request){
        return json_encode(Teach::query()->join('courses','courses.course_id','=',
            'teach.course_id')
            ->select('courses.name','courses.course_id')->where('teach.instructor_id',
                '=',$request->instructorID)->get());
    }
    public function deleteInstructorCourse(Request $request)
    {
        if(Teach::query()->where('course_id','=',$request->courseID)
            ->where('instructor_id','=',$request->instructorID)
            ->delete())
        {
            //$message="Course Deleted Successfully";
            $courses=self::getInstructorCourses($request->instructorID);
            return view('staff/Courses',['courses' => $courses]);
        }
    }
}
