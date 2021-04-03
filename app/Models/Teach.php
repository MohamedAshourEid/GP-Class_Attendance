<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    //
    protected $table = "teach";
    protected $fillable = ['course_id', 'instructor_id'];

    public $timestamps = false;

    
}
