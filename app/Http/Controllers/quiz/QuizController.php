<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\Models\grade;
use App\Models\questionOption;
use App\Models\Quiz;
use App\Models\quizQuestion;
use App\Models\Student;
use App\Models\studentAnswers;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function createQuiz(Request $request){
        $quizID = 'q8'; // generate id for this quiz
        // save quiz

        Quiz::create([
            'id' => $quizID,
            'courseID' => 'CS150',
            'topic' => 'quiz topic'
        ]);

        $questionsCount = $request->questionsCount;
//        return $request;
        for($i=1; $i<=$questionsCount; $i++) {
            $questionID = 'question'.$i;
            $correctAnswerID = 'correctAnswer'.$i;
            $count = 'optionCount'.$i;
            $questionOptions = $request->$count;
// q1question1
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
                        'quiz_id' => $quizID,
                        'options' => $questionOptionContent
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

    public function showQuizes($courseID){

        $quizes = Quiz::query()
            ->where('courseID' , '=' , "{$courseID}")
            ->get();



        return view('staff/quizes',[ 'quizes' =>$quizes]);
    }

    public function showQuize($quizID){



        $questions = quizQuestion::query()
            ->where('quiz_id', '=', "{$quizID}")
            ->get();

//        return $questions;
        $options2 = [];



//            $options = questionOption::query()
//                ->where('question_id', '=', "{$questions->id}")
//                ->get();

        $allQuestions = [];
        $i = 0;
        foreach ($questions as $question) {
            $questionWithAnswer = [];

            $options = questionOption::query()
                ->where('question_id', '=', "{$question->id}")
                ->get();
//            return $options;

            $questionWithAnswer['question'.$i] =$question->content;
            $questionWithAnswer['correctAnswer'.$i] =$question->answer_id;
            $j = 0;
            foreach ($options as $option){

                $questionWithAnswer['option'.$j++] = $option->options;

            }
//            $questionWithAnswer['optionsCount'.$i] = $j;
//            return $questionWithAnswer;
            $allQuestions[$i++] = $questionWithAnswer;

        }
        $test = Json_encode($allQuestions);
        $test2 = Json_decode($test,false);
//        return ( $allQuestions);
        $test3 = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];


//        $request = new Illuminate\Http\Request($allQuestions);
        $test->toJson();


        return view("staff/editQuiz",['questions'=>Json_encode($allQuestions)]);

    }
}
