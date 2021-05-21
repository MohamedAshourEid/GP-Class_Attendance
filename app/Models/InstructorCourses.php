<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorCourses extends Model
{
    protected $table = "instructorcourses";
    protected $fillable = ['id','instructor_id','course_id'];

    public $timestamps=false;
}
