<?php

namespace App\Http\Controllers\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /*
     * this function take the question id and return the answers of this question*/
    public static function getQnswers($questionID)
    {
       return Answer::query()->select('content')
           ->where('question_id','=',$questionID)
           ->get();
    }
}
