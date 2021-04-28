<?php

namespace App\Http\Controllers\User;
session_start();
use App\Http\Controllers\Traits\requestTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class userRegistration extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
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
                $error = 'user already exist';
                return requestTrait::handleRegistrationRequest($request,$error);
            }
        }
        else{
            $student = new \App\Models\Student();
            $result = $student->search($id,$email);
            if ($result->isEmpty()){
                $student->store($id,$Fname,$Lname,$email,$password);
                return $this->login($request);
            }
            else {
                $error = 'user already exist';
                return requestTrait::handleRegistrationRequest($request,$error);
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
                return requestTrait::handleRegistrationRequest($request,$error);
            }
            else {

                //$request->session()->put('instructorID',$id);
                session(['instructorID' => $id]);
                $success="User logged in successfully";
                return requestTrait::handleSuccessOfRequest($request,$success);
            }
        }
        else{
            $student = new \App\Models\Student();
            $result = $student->search_logIn($id,$password);
            if ($result->isEmpty()){
                $error = 'id or password are wrong';
                return requestTrait::handleRegistrationRequest($request,$error);
            }
            else {
                $success="U logged in successfully";
                return requestTrait::handleSuccessOfRequest($request,$success);
            }
        }
    }
}
