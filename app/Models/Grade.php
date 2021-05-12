<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = "grades";
    protected $fillable = ['id','student_id','quiz_id','grade'];

    public $timestamps=false;
}
