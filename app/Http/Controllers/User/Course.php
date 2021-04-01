<?php
namespace App\Http\Controllers\User;
session()->start();

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Course extends Controller
{
    //
    public function showCourse($id){
//        return $id;
        return view('staff/course',['courseID' => $id]);

    }

    public function getEnrolledCourses(){
        $instructorID = session('instructorID');
        $teach = new \App\Models\Teach();
        $courses = $teach->getInctructorCourses($instructorID);
        return view("staff/Home",['courses' => $courses]);
    }
}
