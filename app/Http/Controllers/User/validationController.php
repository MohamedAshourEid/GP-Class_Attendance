<?php

namespace App\Http\Controllers\User;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class validationController extends Controller
{
    //validate data of login
    public static function validata_in(Request $request){
        $validator=Validator::make($request->all(),[
            'id'=>'required|numeric|min:6',
            'password'=>'required|alphaNum|min:8'
        ]);

        return $validator;

    }
    //validate data of sign up
    public static function validata_up(Request $request){
        $validator;
        if($request->type==1)
        {
            $validator=Validator::make($request->all(),[
                'first_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
                'last_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
                'email'=>'required|email',
                'id'=>'required|min:6|numeric|unique:instructors,id',
                'password'=>'required|alphaNum|min:8'

            ]);
        }
        $validator=Validator::make($request->all(),[
            'first_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'last_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'email'=>'required|email',
            'id'=>'required|min:6|numeric|unique:students,id',
            'password'=>'required|alphaNum|min:8'

        ]);


        return $validator;

    }
    //check if the user has account or not and return message but this used inside the userController
    public static function checkLogin_data($request)
    {
        $userData;
        if($request->type==1){
            $userData=Instructor::where([['id','=',$request->id]])->first();
        }
        else{
            $userData=Student::where([['student_id','=',$request->id]])->first();
        }
        if (Hash::check($request->password, $userData->password)) {
            return redirect('welcome');
        }
        else{
            return redirect()->back()->with(['error'=>'ID or Password is invalid']);
        }
    }
    //check if the user has account or not and return message but this used inside the api
    public static function checkLogin_data_of_api($request)
    {
        $userData;
        if($request->type==1){
            $userData=Instructor::where([['id','=',$request->id]])->first();
        }
        else{
            $userData=Student::where([['student_id','=',$request->id]])->first();

        }
        if (Hash::check($request->password, $userData->password)) {
            return ['success'=>'done and login'];
        }
        else{
            return ['error'=>'invalid id or password'];
        }
    }
    //insert in databse based on the type of the user student or instructor
    public static function insertInDatabase($request)
    {
        if($request->type==1)
        {
            Instructor::create([
                'id'=>$request->id,
                'Fname'=>$request->first_name,
                'Lname'=>$request->last_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)

            ]);
        }
        else{
            Student::create([
                'student_id'=>$request->id,
                'Fname'=>$request->first_name,
                'Lname'=>$request->last_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),

            ]);
        }

    }
}
