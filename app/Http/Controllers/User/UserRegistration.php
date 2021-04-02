<?php

namespace App\Http\Controllers\User;
session()->start();
use App\Models\Teach;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
            else {
                $errors = 'user allready exist';
                return Redirect()->back()->withErrors($errors);//->withInputs($request->all());
//                return "user allready exist ";
            }
        }
        else{
            $student = newlogin \App\Models\Student();
            $result = $student->search($id,$email);
            if ($result->isEmpty()){
                $student->store($id,$Fname,$Lname,$email,$password);
                return $this->login($request);
            }
            else {
                $error = 'user allready exist';
                return Redirect()->back()->withErrors($error);//->withInputs($request->all());
//                return "user allready exist ";
            }
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
                $error = 'id or password are wrong';
                return Redirect()->back()->withErrors($error);
            }
            else {
                session(['instructorID' => $id]);
                return redirect()->route('home');
            }
        }
        else{
            $student = new \App\Models\Student();
            $result = $student->search_logIn($id,$password);
            if ($result->isEmpty()){
                $error = 'id or password are wrong';
                return Redirect()->back()->withErrors($error);
            }
            else {
//                return \redirect('home');
                return view("staff/Home");
            }
        }
    }
}

