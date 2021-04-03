<?php

namespace App\Http\Controllers\Session;
use App\Models\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QrCode\QrCodeController;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class SessionController extends Controller
{
    protected $ID;
    protected $session_name;
    protected $date;


    public static function createSession(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        // generate unique id
        $sessionID = $date.substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9);
        $session=new SessionController();
        $session->ID=$sessionID;
        $session->session_name=$request->session_name;
        $session->date=$date;
        if($session->saveSession($session,$request)){
            return QrCodeController::showQrCode($request,$sessionID);
        }else{
            return view('staff/QrCode',['error' => 'There error during creating session']);
        }



    }
    public function saveSession(SessionController $session,Request $req)
    {
        if(Session::create(
            ['session_name'=>$session->session_name,
                'session_id'=>$session->ID,
                'date'=>$session->date]))
        {
            return true;
        }
    }

}
