<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    //
    protected $table = "grades";
    protected $fillable = ['course_id','quiz_id','student_id','grade'];

    public $timestamps=false;
}
