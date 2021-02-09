<?php

namespace App\Http\Controllers\User;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function signup()
    {
        return view('Registeration.SignUp');
    }
    public function login()
    {
        return view('Registeration.Login');
    }
     //validata sign up data and save in database
    public function save_data(Request $request)
    {
        $validator=validationController::validata_up($request);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        validationController::insertInDatabase($request);
        return redirect()->back()->with(['success'=>'Signed Up Successfully']);
    }
     //validata login data and check in database
    public function validate_login(Request $request){

        $validator=validationController::validata_in($request);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        $userData=Instructor::where([['id','=',$request->id],['password','=', $request->password]])->first();

        return validationController::checkLogin_data($request);

    }

}
