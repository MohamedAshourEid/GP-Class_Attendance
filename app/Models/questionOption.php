<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questionOption extends Model
{
    //
    protected $table = "questionOptions";
    protected $fillable = ['quiz_id','question_id','options'];

    public $timestamps=false;
}
