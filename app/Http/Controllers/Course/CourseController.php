<?php
/*
 * Author : Alaa Ibrahim
 * */
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
    /*Created by Mohammed Ashore*/
    public function showCourse($id){
        //return $id;
        return view('staff/course',['courseID' => $id]);

    }
    /*
     * here i create course where i take the name and id of course to create it
     * if the course is already exist return message
     * if it created return success message*/
    public static function createCourse(Request $request){

        //check if the course already existed
        $result=CourseController::search($request);
        if($result==true)
        {
            if(Course::create(['name'=>$request->name, 'course_id'=>$request->courseID]))
            {
                if(self::save_instructor_in_course($request))
                {
                    $message="Course Created and you joined it";
                    return requestTrait::handleCreateCourseRequest($request,$message);
                }

            }
            $message='Course Not Created';
            return requestTrait::handleCreateCourseRequest($request,$message);
            //return view('staff/createCourse',['error' => 'Course Not Created']);
        }
        else{
            $message='Course already exist';
            return requestTrait::handleCreateCourseRequest($request,$message);
        }


    }
    /*
     * if the instructor or student want to join course
     * */
    public static function joinCourse(Request $request){
       if($request->role=='instructor')
       {
           return self::checkIfInstructorIsJoinedCourseAndSaveit($request);

       }
       else{
           return self::checkIfStudentIsJoinedCourseAndSaveit($request);
       }
    }
    /*if the user is instructor
    first i check if the course is exist or not
    second i check if is already joined the course and teach it or not then save it
    */
    public static function checkIfInstructorIsJoinedCourseAndSaveit(Request $request)
    {
        if(!CourseController::search($request))
        {
            $result=Teach::query()->where('course_id', '=', $request->courseID)
                ->Where('instructor_id', '=', $request->ID)
                ->get();
            if($result->isEmpty())
            {
                if(self::save_instructor_in_course($request))
                {
                    $message='You joined the course successfully';
                    return requestTrait::handleJoinCourseRequest($request,$message);
                }
            }
            else{
                $message='You already joined the course';
                return requestTrait::handleJoinCourseRequest($request,$message);
            }
        }
        else{
            $error='Course Not Found';
            return requestTrait::handleJoinCourseRequest($request,$error);
        }

    }
    /*if the user is student
    first i check if the course is exist or not
    second i check if is already enrolled in the course or not then save it
    */
    public static function checkIfStudentIsJoinedCourseAndSaveit(Request $request){
        if(!CourseController::search($request)) {
            $result = Enrolled_Courses::query()->where('course_id', '=', "{$request->courseID}")
                ->Where('student_id', '=', "{$request->ID}")
                ->get();
            if ($result->isEmpty()) {
                if(self::save_student_in_course($request))
                {
                    $message='You joined the course';
                    return requestTrait::handleJoinCourseRequest($request,$message);
                }

            } else {
                $message = 'You already joined the course';
                return requestTrait::handleJoinCourseRequest($request, $message);
            }
        }
        else{
            $message='Course Not Found';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    /*
     * save instructor in teaching this course*/
    public static function save_instructor_in_course(Request $request){
        if(Teach::create(['course_id'=>$request->courseID,
            'instructor_id'=>$request->ID]))
        {
            return true;
        }
    }
    /*
     *save student in this course
     */
    public static function save_student_in_course(Request $request){
        if(Enrolled_Courses::create(['course_id'=>$request->courseID,
            'student_id'=>$request->ID]))
        {
            $message='You joined the course';
            return requestTrait::handleJoinCourseRequest($request,$message);
        }
    }
    /*
     * check if the course is found or not*/
    public static function search(Request $request){
        $result= Course::query()
            ->where('course_id', '=', "{$request->courseID}")
            ->get();
        if($result->isEmpty()){
            return true;
        }
        else{
            return false;
        }
    }
    /*get all courses that student enrolled in it*/
    public function getEnrolledCourses(Request $request)
    {
        return json_encode(Enrolled_Courses::query()->join('courses','courses.course_id','=',
            'enrolled_courses.course_id')
        ->select('courses.name')->where('enrolled_courses.student_id',
             '=',"$request->studentID")->get());
    }
    public static function deleteCourse(Request $request)
    {
        if(Course::query()->where('course_id','=',$request->courseID)->delete())
        {
            if(Teach::query()->where('course_id','=',$request->courseID)->delete())
            {
                return view('staff/Courses');
            }
        }
    }
}
