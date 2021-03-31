<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Course extends Controller
{
    //
    public function showCourse($id){
//        return $id;
        return view('staff/course',['courseID' => $id]);

    }
}
