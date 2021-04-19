<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studentAnswers extends Model
{
    //
    protected $table = "studentAnswers";
    protected $fillable = [ 'question_id','id'];

    public $timestamps = false;
}
