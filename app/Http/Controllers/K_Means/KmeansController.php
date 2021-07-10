<?php

namespace App\Http\Controllers\K_Means;
//require_once __DIR__ . '/vendor/autoload.php';

use App\Models\question;
use App\Models\StudentPerformance;
use App\Models\TrainingSet;
use phpDocumentor\Reflection\Type;
use Phpml\Classification\KNearestNeighbors;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use DB;


class KmeansController extends Controller
{
    public static function kMeansquiz(){
        $studentsWithGrades = self::getquizgrade();
        $clusterer = new KMeans(5);
        $clusters = $clusterer->cluster($studentsWithGrades);
        $performance = array();

        for ($i = 0; $i < 5; $i++){
            $students = array_keys($clusters[$i]);
            $numberofstudents= count($students);
            $numberofquizzes=count(array_values($clusters[$i])[0]);
            $final=0;
            for ($j = 0; $j < $numberofstudents; $j++) {
                $sumofgrades = array_sum(array_values($clusters[$i])[$j]);
                $averageofgrades=$sumofgrades/$numberofquizzes;
                $final+=$averageofgrades;
            }

            $clusterDegree = ($final/$numberofstudents)*10;
            $rate = self::getRate($clusterDegree);

            self::saveStudentsPerformance($students,$rate);
            $performance ["cluster ".($i+1)]=$rate;
        }
    }

    public static function kMeansattendance(){
        $studentsattend = self::getattendancedata();
        $clustering = new KMeans(2);
        $clusters = $clustering->cluster($studentsattend);
        $performance = array();

        for ($i = 0; $i < 2; $i++){
            $students = array_keys($clusters[$i]);
            $numberofstudents= count($students);
            $numberofsessions=count(array_values($clusters[$i])[0]);
            $attended=0;
            for ($j = 0; $j < $numberofstudents; $j++) {
                $sumofattended = array_sum(array_values($clusters[$i])[$j]);
                $averageofattended=$sumofattended/$numberofsessions;
                $attended+=$averageofattended;
            }
            $clusterDegree = ($attended/$numberofstudents);
            $regularity = self::getRegularity($clusterDegree);

            self::saveStudentsRegularity($students,$regularity);
            $performance ["cluster ".($i+1)]=$regularity;
        }
        return $performance;

    }

    public static function getquizgrade(){
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
        return $studentsWithGrades;
    }

    public static function getattendancedata(){
        $studentIDs=Student::query()->select('student_id')
            ->get();
        $attendanceData=Attendance::query()->select('student_id','attended')
            ->get();
        $studentsattend=[];

        foreach ($studentIDs as $id)
        {

            $SID="";
            $attendance=array();

            foreach ($attendanceData as $Data)
            {
                if($id->student_id==$Data->student_id)
                {
                    $attendance[]=(int)$Data->attended;
                    $SID=$Data->student_id;

                }
            }
            if($SID!="")
                $studentsattend[$SID]=$attendance;
        }
        return $studentsattend;
    }

    public static function getRate($clusterDegree){
        if ($clusterDegree>=85) $rate="A";
        elseif ($clusterDegree>=75) $rate="B";
        elseif ($clusterDegree>=65) $rate="C";
        elseif ($clusterDegree>=50) $rate="D";
        else $rate="F";

        return $rate;
    }

    public static function getRegularity($cluster){
        if ($cluster>0.5) $Regularity="regular";
        else $Regularity="irregular";
        return $Regularity;
    }

    public static function saveStudentsPerformance($students,$rate){
        foreach ($students as $student){

            StudentPerformance::where('student_id', $student)
                ->update([
                    'performance' => $rate
                ]);

            /*StudentPerformance::create([
                'student_id' => $student,
                'performance' => $rate
            ]);*/
        }

    }

    public static function saveStudentsRegularity($students,$Regularity){

        foreach ($students as $student) {
            StudentPerformance::where('student_id', $student)
                ->update([
                    'attendance' => $Regularity
                ]);
/*       DB::update('update studentsperformance set attendance = ? where student_id = ?',[$Regularity,$student]);*/

        }

        }





}
