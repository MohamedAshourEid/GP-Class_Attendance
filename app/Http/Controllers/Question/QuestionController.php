<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /*public function createQuestion(Request $request)
    {
        if(QuestionController::search($request)){
            if(Question::create(['quiz_id'=>$request->quizID,'content'=>$request->Content])){
                return 'Question add successfully';
            }

        }
        else{
            return 'Question is already exist';
        }
        //return requestTrait::handleCreateQuestionRequest($request,$message);
    }*/

    /*public function deleteQuestion(Request $request){
        $result=Question::query()
            ->where('id','=',$request->ID)
            ->where('quiz_id','=',$request->quizID)
            ->delete();
        if($result){
            //$message='Question deleted successfully';
            return 'Question deleted successfully';
            //return requestTrait::handleDeleteQuizRequest($request,$message);
        }
        $message='Error ,question not deleted';
        return 'Error ,question not deleted';
        //return requestTrait::handleDeleteQuizRequest($request,$message);
    }*/
    /*search on question and if not found return true else return false*/
   /*public static function search(Request $request){
       $result= Question::query()
           ->where('quiz_id', '=', "{$request->quizID}")
           ->Where('content', '=', "{$request->Content}")
           ->get();
       if($result->isEmpty()){
           return true;
       }
       else{
           return false;
       }
   }*/
  /*
   * this function take the quiz id and return all question in this quiz*/
   public static function getQuestions($quizID){
       return Question::query()->select('content','quiz_id','id')
           ->where('quiz_id','=',$quizID)
           ->get();
   }
}
