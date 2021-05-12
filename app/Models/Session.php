<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "sessions";
    protected $fillable = ['id','session_name','session_id','course_id','date'];

    public $timestamps=false;

}
