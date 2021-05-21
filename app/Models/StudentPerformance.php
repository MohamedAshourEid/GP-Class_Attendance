<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPerformance extends Model
{
    protected $table = "studentsPerformance";
    protected $fillable = ['course_id', 'student_id','performance', 'attendance'];

    public $timestamps = false;
}
