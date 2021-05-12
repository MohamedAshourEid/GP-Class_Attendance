<?php

namespace App\Http\Controllers\K_Means;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class KmeansController extends Controller
{
    public static function readData()
    {
        $studentIDs=Student::query()->select('student_id')
            ->get();
        $gradesData=Grade::query()->select('student_id','grade')
            ->get();
        $studentsWithGrades=array();
        $j=1;
        foreach ($studentIDs as $id)
        {
            $gradesStudent=array();
            $gradesStudent['id']=$id->student_id;
            //echo $id->student_id."----";
            $i=1;
            foreach ($gradesData as $grade)
            {
                if($grade->student_id==$id->student_id)
                {
                    //echo $grade->grade.'---';
                    $gradesStudent['grade'.$i++]=$grade->grade;
                }
            }
            //print_r($gradesStudent);
            $studentsWithGrades['student'.$j++]=$gradesStudent;
            //echo "<br>";
        }
        return $studentsWithGrades;
    }
}
