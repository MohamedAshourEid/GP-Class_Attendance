<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\Models\grade;
use App\Models\questionOption;
use App\Models\quizQuestion;
use App\Models\Student;
use App\Models\studentAnswers;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function createQuiz(Request $request){
        $quizID = 'q1'; // generate id for this quiz
        // save quiz
        $questionsCount = $request->questionsCount;

        for($i=1; $i<=$questionsCount; $i++) {
            $questionID = 'question'.$i;
            $correctAnswerID = 'correctAnswer'.$i;
            $count = 'optionCount'.$i;
            $questionOptions = $request->$count;

            if ($request->$questionID) {
                // save question and its correct answer
                quizQuestion::create([
                    'id' => $quizID.$questionID,
                    'quiz_id' => $quizID,
                    'content' => $request->$questionID,
                    'answer_id' => $request->$correctAnswerID
                ]);
                // sava question and its options
                for ($j = 1; $j <= $questionOptions; $j++) {
                    $questionOption = 'question' . $i . 'option' . $j;
                    $questionOptionContent = $request->$questionOption;
                    questionOption::create([
                        'question_id' => $quizID . $questionID,
                        'id' => $quizID . $questionOption,
                        'option' => $questionOptionContent
                    ]);
                }
            }
        }
    }

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
}
