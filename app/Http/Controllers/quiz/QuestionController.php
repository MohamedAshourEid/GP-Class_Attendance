<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\Models\choice;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveQuestion($quizID,$questionID,$correctAnswer){
        $questionID = Question::insertGetId([
            'quiz_id' => $quizID,
            'content' => $questionID,
            'answer_id' => $correctAnswer
        ]);
        return $questionID;

    }

    public static function saveQuestions(Request $request){
        $quizID = $request->quizID;
        $questionsCount = $request->questionsCount; // number of questions in this request
        for($i=1; $i<=$questionsCount; $i++) {
            $correctAnswer = 'correctAnswer'.$i;
            $count = 'optionCount'.$i;
            $content = 'question'.$i;
            $questionOptions = $request->$count;

            if ($request->$content) {
                // save question and its correct answer
                $questionID = QuestionController::saveQuestion($quizID,$request->$content,$request->$correctAnswer);
                // sava question and its options
                for ($j = 1; $j <= $questionOptions; $j++) {
                    $questionOption = 'question' . $i . 'option' . $j;
                    $questionOptionContent = $request->$questionOption;
                    QuestionController::saveChoice($questionID, $quizID, $questionOptionContent);
                }
            }
        }
    }

    public static function saveChoice($questionID,$quizID,$choice){
        choice::create([
            'question_id' =>$questionID,
            'quiz_id' => $quizID,
            'options' => $choice
        ]);
    }

    public function update(Request $request)
    {
        $question= Question::findOrFail($request->id);
        $question-> content =$request['content'];
        $question-> answer_id =$request['correctAnswer'];
        $question->save();

        $arr=$request->choices;
        $choices= choice::query()
            ->where('question_id', '=', "{$request->id}")
            ->get();

        for  ($i=0;$i<sizeof($arr);$i++) {
            choice::where('option_id', '=',$choices[$i]->option_id)
                ->update(array('options' => $arr[$i]));
        }
    }

    public function destroy(Request $request){
        Question::destroy($request->id);
        choice::where('question_id','=',"{$request->id}")
            ->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
