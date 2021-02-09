<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "sessions";
    protected $fillable = ['session_id','course_id','instructor_id'];

    public $timestamps=false;
}
