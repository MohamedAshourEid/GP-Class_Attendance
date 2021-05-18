<?php

namespace App\Http\Controllers\K_Means;
//require_once __DIR__ . '/vendor/autoload.php';

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
        $studentIDs=Student::query()->select('id')
            ->get();

        $gradesData=Grade::query()->select('student_id','grade')
            ->get();
//        return $gradesData;
        $studentsWithGrades=array();
        $j=0;
        foreach ($studentIDs as $id)
        {
            foreach ($gradesData as $grade)
            {
                if($grade->student_id==$id->id)
                {
                    $studentsWithGrades[$j++] = [$grade->grade,$id->id];
                }
            }
        }
        $samples = [[1, 1,5], [8, 7,9], [1, 2,6], [7, 8,7], [2, 1,0], [8, 9,5]];
        $kmeans = new KMeans(3);
//        return $studentsWithGrades;
        return $kmeans->cluster($studentsWithGrades);

    }
}
