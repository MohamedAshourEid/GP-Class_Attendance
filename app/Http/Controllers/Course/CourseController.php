<?php
namespace App\Http\Controllers\Course;
session()->start();
use App\Models\Course;
use App\Models\Teach;
use App\Models\Enrolled_Courses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\requestTrait;

class CourseController extends Controller
{
    //
    public function showCourse($id){
        //return $id;
        return view('staff/course',['courseID' => $id]);

    }
    public static function createCourse(Request $request){

        //check if the course already existed
        $result=CourseController::search($request);
        if($request==true)
        {
            if(Course::create(['name'=>$request->name, 'course_id'=>$request->courseID]))
            {
                $message="Course Created Successfully";
                return requestTrait::handelCourseRequest($request,$message);
            }
            $message='Course Not Created';
            return requestTrait::handelCourseRequest($request,$message);
            //return view('staff/createCourse',['error' => 'Course Not Created']);
        }
        else{
            $message='Course arleady exist';
            return requestTrait::handelCourseRequest($request,$message);
        }


    }
    public static function joinCourse(Request $request){
       if($request->role=='instructor')
       {
           return self::checkIfInstructorIsJoinedCourseAndSaveit($request);

       }
       else{
           return self::checkIfStudentIsJoinedCourseAndSaveit($request);
       }
    }

    public static function checkIfInstructorIsJoinedCourseAndSaveit(Request $request)
    {
            $result=Teach::query()->where('course_id', '=', "{$request->courseID}")
                ->Where('instructor_id', '=', "{$request->ID}")
                ->get();
        if($result->isEmpty())
        {
           return self::save_instructor_in_course($request);
        }
        else{
            $message='You already joined the course';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    public static function checkIfStudentIsJoinedCourseAndSaveit(Request $request){
        $result=Enrolled_Courses::query()->where('course_id', '=', "{$request->courseID}")
            ->Where('student_id', '=', "{$request->ID}")
            ->get();
        if($result->isEmpty())
        {
            return self::save_student_in_course($request);
        }
        else{
            $message='You already joined the course';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    public static function save_instructor_in_course(Request $request){
        if(Teach::create(['course_id'=>$request->courseID,
            'instructor_id'=>$request->ID]))
        {
            $message='You joined the course';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    public static function save_student_in_course(Request $request){
        if(Enrolled_Courses::create(['course_id'=>$request->courseID,
            'student_id'=>$request->ID]))
        {
            $message='You joined the course';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    public static function search(Request $request){
        $result= Course::query()
            ->where('course_id', '=', "{$request->courseID}")
            ->Where('name', '=', "{$request->name}")
            ->get();
        if($result->isEmpty()){
            return true;
        }
        else{
            return false;
        }
    }
}
