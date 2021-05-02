<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    //
    protected $table = "quizquestions";
    protected $fillable = ['id', 'quiz_id', 'content', 'answer_id'];

    public $timestamps = false;
    public $incrementing = false;
}
