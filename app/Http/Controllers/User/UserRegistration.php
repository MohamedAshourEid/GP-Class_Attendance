<?php

namespace App\Http\Controllers\User;
use App\Models\Teach;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRegistration extends Controller
{
    public function signUp(Request $request){

        $role = $request->role;
        $id = $request->id;
        $Fname = $request->first_name;
        $Lname = $request->last_name;
        $email = $request ->email;
        $password = $request->password;

        if($role === "instructor"){
            $instrutor = new \App\Models\Instructor();
            $result = $instrutor->search($id,$email);
            if ($result->isEmpty()){
                $instrutor->store($id,$Fname,$Lname,$email,$password);
                return $this->login($request);
            }
            else {return "user allready exist ";}
        }
        else{
            $student = newlogin \App\Models\Student();
            $result = $student->search($id,$email);
            if ($result->isEmpty()){
                $student->store($id,$Fname,$Lname,$email,$password);
                return $this->login($request);
            }
            else {return "user allready exist ";}
        }
    }

    public function login(Request $request){
        $role = $request->role;
        $id = $request->id;
        $password = $request->password;

        if($role === "instructor") {
            $instrutor = new \App\Models\Instructor();
            $result = $instrutor->search_logIn($id,$password);
            if ($result->isEmpty()){
                return "id or password are wrong";
            }
            else {
                $teach = new \App\Models\Teach();
                $courses = $teach->getInctructorCourses($id);
                return view("staff/Home",['courses' => $courses]);
            }
        }
        else{
            $student = new \App\Models\Student();
            $result = $student->search_logIn($id,$password);
            if ($result->isEmpty()){
                return "id or password are wrong";
            }
            else {return view("staff/Home");}
        }
    }
}
