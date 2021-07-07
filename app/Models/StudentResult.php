<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $table = "studentresults";
    protected $fillable = ['id','number_of_attendance','year_works','course_id','student_id','finalresult'];

    public $timestamps=false;
}
