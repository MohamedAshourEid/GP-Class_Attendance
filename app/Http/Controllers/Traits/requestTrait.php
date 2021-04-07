<?php


namespace App\Http\Controllers\Traits;


use Illuminate\Http\Request;

class requestTrait
{
      public static function handelCreateCourseRequest(Request $request,$message)
      {
          if($request->ajax())
          {
              return json_encode($message);
          }
          else{
              return view('staff/createCourse',['success' => $message]);
          }
      }
      public static function handleJoinCourseRequest(Request $request,$message){
          if($request->ajax())
          {
              return json_encode($message);
          }else{
              return view('staff/joinCourse',['success' => $message]);
          }
      }
      public static function handeRegisterationRequest(Request $request,$error){
          if($request->ajax())
          {
              return json_encode($error);
          }
          else{
              return Redirect()->back()->withErrors($error);
          }
      }
}
