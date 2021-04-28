<?php
/*
 * Author : Alaa Ibrahim
 * */
namespace App\Http\Controllers\Session;
use App\Models\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QrCode\QrCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\This;

class SessionController extends Controller
{
    /**
     * @var
     */
    protected $ID;
    protected $session_name;
    protected $date;

    /*
     * This function is used to create session
     * */
    public static function createSession(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        // generate unique id
        $sessionID = $date.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);
        $session=new SessionController();
        $session->ID=$sessionID;
        $session->session_name=$request->session_name;
        $session->date=$date;
        return self::validateSessionNAmeThenSaveSession($session,$request);
    }
    /*
     * here i validate the name and if is valid i create the session
     * then i call showQrCode function to show the Qr Code to the students*/
    public static function validateSessionNAmeThenSaveSession(SessionController $session,Request $request)
    {
        if(strlen($session->session_name)==0)
        {
            $errors='session name is empty,please try again';
            return Redirect()->back()->withErrors($errors);
        }
        elseif(strlen($session->session_name)<5)
        {
            $errors='Session name is so short,please enter valid name';
            return Redirect()->back()->withErrors($errors);
        }
        else{
            Session::create(
                ['session_name'=>$session->session_name,
                    'session_id'=>$session->ID,
                    'date'=>$session->date]);

            return QrCodeController::showQrCode($request,$session->ID);
        }

    }
    /*Get sessions of particular course fro the instructor*/
    public static function getSessionsOfCourse(Request $request){
        return json_encode(Session::query()->select('session_name','session_id','date')
            ->where('course_id','=',$request->courseID)
            ->get());
    }

}
