<?php

namespace App\Http\Controllers\Grade;

use App\Models\Student;
use Faker\Factory as faker;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function addData()
    {
        // Open a file
        $file = fopen("C:/Users/Alaa_Ibrahim/Downloads/grades.csv", "r");

        // Fetching data from csv file row by row
        while (!(($data = fgetcsv($file)) === false)) {
            Student::create(['student_id' => $data[0], 'Fname' => $data[1], 'Lname' => $data[2],
                'email'=>$data[3],'password'=>$data[4]]);
        }

        // Closing the file
        fclose($file);
    }
    /*public function getAllData(){
        $IDs=Student::query()->select('student_id')
            ->get();
        return count($IDs);

    }*/
    public function generate(){
        //require_once 'vendor/autoload.php';

        // use the factory to create a Faker\Generator instance
        $IDs=Grade::query()->where('quiz_id','=',1)
            ->select('student_id')
        ->get();
        //echo count($IDs);
        //return ($IDs);
        $faker = Faker::create();
        // generate data by calling methods
        //$i=0;
        for($i=1;$i<=500;$i++)
        {
            /*Student::create(['student_id'=>$id->student_id,'Fname'=>$faker->firstName(),
                'Lname'=>$faker->lastName(),'email'=>$faker->email(),'password'=>$faker->password()]);*/
            //$i++;
            //echo $id->student_id."+++";
            //echo $faker->firstName()."<br>";
            echo $faker->password()."<br>";
        }

    }
}
