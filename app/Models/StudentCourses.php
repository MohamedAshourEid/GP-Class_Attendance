<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    protected $table = "studentcourses";
    protected $fillable = ['id','student_id','course_id'];

    public $timestamps=false;
}
