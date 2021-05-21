<?php

namespace App\Http\Controllers\K_Means;
//require_once __DIR__ . '/vendor/autoload.php';

use App\Models\question;
use phpDocumentor\Reflection\Type;
use Phpml\Classification\KNearestNeighbors;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

class KmeansController extends Controller
{
    public static function readData()
    {
        $studentIDs=Student::query()->select('student_id')
            ->get();
        $gradesData=Grade::query()->select('student_id','grade')
            ->get();
        $studentsWithGrades=[];
        $j=0;
        foreach ($studentIDs as $id)
        {
            $gradesStudent=array();
            //$gradesStudent['id']=$id->student_id;
            //echo $id->student_id."----";
            //$i=1;
            foreach ($gradesData as $grade)
            {
                if($grade->student_id==$id->student_id)
                {
                    $gradesStudent[]=(float)$grade->grade;
                }
            }
            $studentsWithGrades[$id->student_id]=$gradesStudent;
        }
        $clusterer = new KMeans(5);
        $clusters = $clusterer->cluster($studentsWithGrades);
        $performance = array();

        for ($i = 0; $i < 5; $i++){
            $students = array_keys($clusters[$i]);
            $numberofstudents= count($students);
            $numberofquizzes=count(array_values($clusters[$i])[0]);
            $final=0;
            for ($j = 0; $j < $numberofstudents; $j++)
            {

                $sumofgrades = array_sum(array_values($clusters[$i])[$j]);
                $averageofgrades=$sumofgrades/$numberofquizzes;

                $final+=$averageofgrades;

            }
            $rate="";
            if (($final/$numberofstudents)*10>=85){
                $rate="A";

            }
            elseif (($final/$numberofstudents)*10>=75){
                $rate="B";

            }
            elseif (($final/$numberofstudents)*10>=65){
                $rate="C";

            }
            elseif (($final/$numberofstudents)*10>=50){
                $rate="D";

            }
            else{
                $rate="F";

            }
            $performance ["cluster ".($i+1)]=$rate;

        }
        print_r($performance);
    }

    public static function saveStudentsPerformance($students,$rate){
        print_r('hi');
    }
}
