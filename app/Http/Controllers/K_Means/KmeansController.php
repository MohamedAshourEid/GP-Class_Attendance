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
    /**
     * @throws \Phpml\Exception\InvalidArgumentException
     */
    public static function readData()
    {
        $studentIDs=Student::query()->select('student_id')
            ->get();
        $gradesData=Grade::query()->select('student_id','grade')
            ->get();
        $studentsWithGrades=[];
        //$j=0;
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
            $numberofstudents= count(array_keys($clusters[$i]));
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
        //print_r($performance);
        return $performance;
    }
    /*public static function clusterData()
    {
        $lines = file('F:/Fourth_year/GP/grades_2.csv');
        return $lines;
        $i=0;
        foreach ($lines as $line) {
            $row = explode(',', $line);
            $line=[];
            for($i=1;$i<count($row);$i++)
            {
                $line=(float)$row[$i];
            }
            $line = [(float) $row[1], (float) $row[2],(float) $row[3], (float) $row[4],
                (float) $row[5], (float) $row[6]];
            $lines[$i++]=$line;
            //print_r($line);
        }
        return $lines;
        $cluster2 = new KMeans(3);
        $clusters = $cluster2->cluster($lines);
        //return $clusters;
        $lines = [];
        foreach ($clusters as $key => $cluster) {
            foreach ($cluster as $sample) {
                $lines[] = sprintf('%s;%s;%s', $key, $sample[0], $sample[1],$sample[2], $sample[3],$sample[4], $sample[5]);
            }
        }
        return $lines;
    }*/
}
