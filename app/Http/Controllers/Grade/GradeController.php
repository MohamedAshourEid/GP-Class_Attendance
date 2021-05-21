<?php

namespace App\Http\Controllers\Grade;

use App\Models\Attendance;
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
    public function generate(){
        //require_once 'vendor/autoload.php';

        // use the factory to create a Faker\Generator instance
        $IDs=Grade::query()->where('quiz_id','=',1)
            ->select('student_id')
        ->get();
        $faker = Faker::create();
        // generate data by calling methods
        //$i=0;
        for($id=20170461;$id<20170501;$id++)
        {
            Student::create(['student_id'=>$id,'Fname'=>$faker->firstName(),
                'Lname'=>$faker->lastName(),'email'=>$faker->email(),'password'=>$faker->password()]);
        }

    }
    /*public static function update()
    {
        $allGrades= Grade::query()->where('quiz_id','=',6)
            ->get();
        foreach($allGrades as $grade)
        {
            $grade->course_id="IS215";
            $grade->save();
        }

    }*/
    /*public static function generateAttendanceData(){
        //session id  ==>>2021-02-05 21:15:059hgx22801
        //session id=>2021-04-01 23:06:4869qzl0800
        //2021-05-01 23:06:4879qzl0700
        //2021-05-10 10:06:4879qmn1200
        //2021-03-28 12:30:4579qmn1200
        //2021-04-28 8:00:4880qmn1800
        for($id=20170001;$id<20170101;$id++)
        {
            $attend=rand(0,1);
            Attendance::create(['course_id'=>'IS215','session_id'=>'2021-03-28 12:30:4579qmn1200',
            'student_id'=>$id,'attended'=>$attend]);
        }

    }*/

}
