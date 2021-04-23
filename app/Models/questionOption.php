<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questionOption extends Model
{
    //
    protected $table = "questionOptions";
    protected $fillable = ['question_id','id','option'];

    public $timestamps=false;
}
