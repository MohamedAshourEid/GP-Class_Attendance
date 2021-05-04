<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\Models\grade;
use App\Models\choice;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Student;
use App\Models\studentAnswers;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function createQuiz(Request $request){
        $quizID = 'q15'; // generate id for this quiz
        $courseID = $request->courseID;
        $topic = $request->quizTopic;
        $this->saveQuiz($quizID,$courseID,$topic);

        $questionsCount = $request->questionsCount; // number of questions in this request
        for($i=1; $i<=$questionsCount; $i++) {
            $questionID = $quizID.'question'.$i;
            $correctAnswerID = 'correctAnswer'.$i;
            $count = 'optionCount'.$i;
            $questionOptions = $request->$count;

            if ($request->$questionID) {
                // save question and its correct answer
                QuestionController::create($questionID,$quizID,$request->$questionID,$request->$correctAnswerID);
                // sava question and its options
                for ($j = 1; $j <= $questionOptions; $j++) {
                    $questionOption = 'question' . $i . 'option' . $j;
                    $questionOptionContent = $request->$questionOption;
                    QuestionController::saveChoice($quizID.$questionID, $quizID, $questionOptionContent);
                }
            }
        }
    }

    public function saveQuiz($quizID,$courseID,$topic){
        Quiz::create([
            'id' => $quizID,
            'courseID' => $courseID,
            'topic' => $topic
        ]);
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
        return question::query()
            ->where('id', '=', "{$question->question_id}")
            ->Where('answer_id', '=', "{$question->answer_id}")
            ->count();

    }

    public function showQuizes($courseID){
        $quizes = Quiz::query()
            ->where('courseID' , '=' , "{$courseID}")
            ->get();
        return view('staff/quizes',[ 'quizes' =>$quizes,'courseID'=>$courseID]);
    }

    public function showQuize($quizID){
        $questions = Question::query()
            ->where('quiz_id', '=', "{$quizID}")
            ->get();

        $allQuestions = [];
        $i = 0;
        foreach ($questions as $question) {
            $questionWithAnswer = [];
            $options = choice::query()
                ->where('question_id', '=', "{$question->id}")
                ->get();
            $questionWithAnswer['question'] =$question->content;
            $questionWithAnswer['questionid'] =$question->id;
            $questionWithAnswer['correctAnswer'] =$question->answer_id;
            $j = 1;
            foreach ($options as $option){
                $questionWithAnswer['option'.$j++] = $option->options;
            }
            $questionWithAnswer['optionsCount'] = $j-1;
            $allQuestions[$i++] = $questionWithAnswer;
        }
//        return $allQuestions;
        return view("staff/editQuiz",['questions'=>$allQuestions, 'quizID'=>$quizID]);
    }
}
