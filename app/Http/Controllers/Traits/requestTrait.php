<?php


namespace App\Http\Controllers\Traits;


use http\Env\Request;

class requestTrait
{
      public static function handleRequestOFSignup(Request $request)
      {
          if($request->ajax())
          {

          }
      }
      public static function handelCreateCourseRequest(Request $request)
      {
          if($request->ajax())
          {
              return json_encode('Course Created Successfully');
          }
          else{
              return view('staff/createCourse',['success' => 'Course Created Successfully']);
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
}
