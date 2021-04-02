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
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validata_in(Request $request)
    {
        return Validator::make($request->all(),[
            'id'=>'required|numeric|min:6',
            'password'=>'required|alphaNum|min:8'
        ]);

    }
    //validate data of sign up
    public static function validata_up(Request $request){
        if($request->role=='instructor')
        {
            return $validator=Validator::make($request->all(),[
                'first_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
                'last_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
                'email'=>'required|email',
                'id'=>'required|min:6|numeric|unique:instructors,id',
                'password'=>'required|alphaNum|min:8'

            ]);
        }
        return $validator=Validator::make($request->all(),[
            'first_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'last_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'email'=>'required|email',
            'id'=>'required|min:6|numeric|unique:students,id',
            'password'=>'required|alphaNum|min:8'

        ]);


    }
    //check if the user has account or not and return message but this used inside the userController
    public static function checkLogin_data($request)
    {
        //$userData="";
        if($request->role=='instructor'){
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
        //$userData="";
        $hashed_password="";
        if($request->role=='instructor'){
            $userData=Instructor::where([['id','=',$request->id]])->first();
            $hashed_password=$userData->password;
        }
        else{
            $userData=Student::where([['student_id','=',$request->id]])->first();
            $hashed_password=$userData->password;

        }
        if (Hash::check($request->password, $hashed_password)) {
            return ['success'=>'done and login'];
        }
        else{
            return ['error'=>'invalid id or password'];
        }
    }
    //insert in databse based on the type of the user student or instructor
    public static function insertInDatabase($request)
    {
        if($request->role=='instructor')
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
