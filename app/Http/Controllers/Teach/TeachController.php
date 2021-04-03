<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teach;
class TeachController extends Controller
{
    //
    public function getEnrolledCourses(){
        $instructorID = session('instructorID');
        $courses = $this->getInstructorCourses($instructorID);
        return view("staff/Home",['courses' => $courses]);
    }
    public static function getInstructorCourses($instructorID){
        return Teach::query()
            ->where('instructor_id', '=', "{$instructorID}")
            ->get();
    }
}
