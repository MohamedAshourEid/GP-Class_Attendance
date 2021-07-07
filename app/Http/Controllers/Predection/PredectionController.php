<?php

namespace App\Http\Controllers\Predection;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\StudentResult;
use Illuminate\Http\Request;
use Phpml\Regression;
use Phpml\Helper\Predictable;
use Phpml\Math\Matrix;
use function Sodium\randombytes_uniform;

class PredectionController extends Controller
{
    public static function generateStudentResults()
    {
        $id=20170001;
        $course_id="IS215";
        for($id;$id<=20170500;$id++)
        {
            $numOfAttendance=rand(0,20);
            $finalResult=rand(20,60);

            $yearWork=Grade::query()->where('student_id','=',$id)
                ->where('course_id','=',$course_id)
                ->sum('grade');
            StudentResult::create(['student_id'=>$id,'course_id'=>$course_id,'number_of_attendance'=>$numOfAttendance,
                'year_works'=>$yearWork,'finalresult'=>$finalResult]);
        }
    }
    public static function predictFinalGrade()
    {
        $samples=array();
        $targets=array();
        for($id=20170001;$id<=20170400;$id++)
        {
            $results=StudentResult::query()->select('number_of_attendance','year_works','finalresult')
                ->where('student_id','=',$id)->first();
            //return $results;
            $sample[]=[$results->number_of_attendance,$results->year_works];
            $samples=$sample;
            $targets[]=$results->finalresult;
        }
        $regression = new Regression\LeastSquares();
        $regression->train($samples, $targets);
        $count=0;
        for($ID=20170401;$ID<=20170500;$ID++)
        {
            $results2=StudentResult::query()->select('number_of_attendance','year_works','finalresult')
                ->where('student_id','=',$ID)->first();
            //return $results;
            $sample2[]=[$results2->number_of_attendance,$results2->year_works];
            echo "Student ".$ID." can get ".$regression->predict([$results2->number_of_attendance,$results2->year_works])." final exam";
            echo "<br><br>";
            //$targets2[]=$results2->finalresult;
        }
        //return $predicted;
        //return $samples;
    }
}
