<?php

namespace App\Http\Controllers\User;

use App\Models\Doctor;
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
        $validator=$this->validata_up($request);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Doctor::create([
            'id'=>$request->id,
            'full_name'=>$request->full_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ]);
        return redirect()->back()->with(['success'=>'Signed Up Successfully']);
    }
     //validata login data and check in database
    public function validate_login(Request $request){

        $validator=$this->validata_in($request);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        $userData=Doctor::where([['id','=',$request->id],['password','=', $request->password]])->first();

        return $this->checkLogin_data($userData);
        //return $userData;


    }
    //validate data of login
    public function validata_in(Request $request){
        $validator=Validator::make($request->all(),[
            'id'=>'required|numeric|min:6',
            'password'=>'required|alphaNum|min:8'
        ]);

        return $validator;

    }
    //validate data of sign up
    public function validata_up(Request $request){
        $validator=Validator::make($request->all(),[
            'full_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'email'=>'required|email',
            'id'=>'required|min:6|numeric|unique:doctors,id',
            'password'=>'required|alphaNum|min:8'

        ]);

        return $validator;

    }
    //check if the user data is found or not
    public function checkLogin_data($userData)
    {
        if($userData!=null)
        {
            return view('welcome');
        }else{
            return redirect()->back()->with(['error'=>'ID or Password is invalid']);
        }
    }

}
