<?php

/*
 * Author : Alaa Ibrahim
 * */
namespace App\Http\Controllers\Traits;


use Illuminate\Http\Request;

class requestTrait
{
       /*this function check if the create course request from API or from the web app
       to return the correct format*/
      public static function handleCreateCourseRequest(Request $request,$message)
      {
          if($request->wantsJson())
          {
              return json_encode($message);
          }
          else{
              return view('staff/createCourse',['success' => $message]);
          }
      }
      /*this function check if the join course request from API or from the web app
       to return the correct format*/
      public static function handleJoinCourseRequest(Request $request,$message){
          if($request->wantsJson())
          {
              return json_encode($message);
          }else{
              return view('staff/joinCourse',['success' => $message]);
          }
      }
    /*this function check if the registration request from API or from the web app
    to return the correct format (deal with error during the registration)*/
    public static function handleRegistrationSuccess(Request $request,$message)
    {
        if($request->wantsJson())
        {
            return json_encode($message);
        }
        return redirect()->route('home');
    }

    public static function handleRegistrationFailure(Request $request,$message)
    {
        if($request->wantsJson())
        {
            return json_encode($message);
        }
        return Redirect()->back()->withErrors($message);
    }
      /*this function check if the registration request from API or from the web app
      to return the correct format .
      it handle the success messages of the registration
      */
      public static function handleSuccessOfRequest(Request $request,$message){
          if($request->wantsJson())
          {
              return json_encode($message);
              //return $message;
          }
          else{
              return redirect()->route('home');
          }
      }


}
