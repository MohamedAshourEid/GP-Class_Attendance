<?php
namespace App\Http\Controllers\Course;
session()->start();

use App\Models\Announcement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{


    public function makepost(Request $request)
    {

       Announcement::create(['course_id' => $request->courseID, 'body' => $request->announcement]);
       $Announcements = Announcement::query()
            ->where('course_id', '=', "$request->courseID")
            ->get();
        session_start();
        session(['courseID' => $request->courseID,'Announcements'=>$Announcements]);
        return view('staff/makeAnnouncement');
    }

    public function updatepost(Request $request)
    {
        return view('staff/updateAnnouncement', ['course_id' => $request->courseID, 'body' => $request->body, 'postid' => $request->postid]);
    }


    public function saveupdate(Request $request)
    {
        Announcement::where(['course_id'=>$request->courseID])
        ->where(['id'=>$request->postid])
            ->update([
                'body' => $request->body
            ]);
        $Announcements = Announcement::query()
            ->where([
                ['course_id', '=', $request->courseID]
            ])
            ->get();
        session_start();
        session(['courseID' => $request->courseID,'Announcements'=>$Announcements]);
        return view('staff/makeAnnouncement');
    }


    public function deletepost(Request $request)
    {
        Announcement::where(['course_id'=>$request->courseID])
            ->where(['id'=>$request->postid])
            ->delete();
        $Announcements = Announcement::query()
            ->where([
                ['course_id', '=', $request->courseID]
            ])
            ->get();
        session_start();
        session(['courseID' => $request->courseID,'Announcements'=>$Announcements]);
        return view('staff/makeAnnouncement');
    }

}
