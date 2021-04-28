<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "quizquestions";
    protected $fillable = ['id', 'quiz_id','content','answer'];

    public $timestamps = false;
}
