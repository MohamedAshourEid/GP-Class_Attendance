<?php

/*
 * Author : Alaa Ibrahim
 * */
namespace App\Http\Controllers\Quiz;
session_start();

use App\Http\Controllers\Answer\AnswerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /*Create new quiz*/
    /*public function createQuiz(Request $request){
        $date=date('Y-m-d H:i:s');
        if(Quiz::create(['courseID'=>$request->courseID,'topic'=>$request->topic,'date'=>$date]))
        {
            $result=Quiz::query()->select('id')
                ->where('courseID','=',$request->courseID)
                ->where('topic','=',$request->topic)
            ->get();
            foreach ($result as $obj)
            {
                session(['quizID' => $obj->id]);
            }

        }
    }*/
    public function quizCorrection(Request $request){
//      $str = '[{"question_id":"q1.question1","answer_id":"q1.question1.o3"},{"question_id":"q1.question2","answer_id":"q1.question2.o1"}]';
        $str = $request->str;
        $questions = json_decode($str,false);
        $grade = 0;
        foreach ($questions as $question){
            $grade += $this->checkAnswer($question);
        }
        grade::create([
            'course_id' => $request->course_id,
            'quiz_id' => $request->quiz_id,
            'student_id' => $request->student_id,
            'grade' => $grade
        ]);

        return json_encode($grade);
    }

    public function checkAnswer($question){
        return quizQuestion::query()
            ->where('id', '=', "{$question->question_id}")
            ->Where('answer_id', '=', "{$question->answer_id}")
            ->count();

    }
    /*Delete quiz*/
    /*public function deleteQuiz(Request $request){
        $result=Quiz::query()
            ->where('courseID','=',$request->courseID)
            ->where('id','=',$request->ID)
            ->delete();
        if($result){
            return 'Quiz deleted successfully';
        }
        return 'Error ,quiz not deleted';
    }*/
    public static function getTopicsOfQuizzes(Request $request)
    {
        $result=Quiz::query()
            ->select('id','topic','date')
            ->where('courseID','=',$request->courseID)
            ->get();
        return json_encode($result);
    }
    public static function getQuestionsandAnswersOfQuiz(Request $request)
    {
        //this array have arrays each one has question with its answers
        $allQuestionsWithThieranswers=array();
        //count number of questions in quiz
        $countOFQuestions=1;
        $questions=QuestionController::getQuestions($request->quizID);
        foreach ($questions as $question)
        {
            $countOFAnswers=1;
            $questionWithAnswers=array();
            $questionWithAnswers['content']=$question->content;
            $questionWithAnswers['quiz_id']=$question->quiz_id;
            $questionWithAnswers['id']=$question->id;
            $answers=AnswerController::getQnswers($question->id);
            foreach ($answers as $answer) {
                $questionWithAnswers['answer'.$countOFAnswers++]=$answer->content;
            }
            $allQuestionsWithThieranswers['question'.$countOFQuestions++]=$questionWithAnswers;

        }
        return json_encode($allQuestionsWithThieranswers);
    }
}
