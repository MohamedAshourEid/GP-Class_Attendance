<?php

namespace App\Http\Controllers\User;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserControllerApi extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //validata sign up data and save in database
    public function save_data(Request $request)
    {
        $validator=validationController::validata_up($request);

        if($validator->fails())
        {
            return $validator->errors();
        }
        validationController::insertInDatabase($request);
        return ['success'=>'done'];
    }
     //validata login data and check in database
    public function validate_login(Request $request){

        $validator=validationController::validata_in($request);

        if($validator->fails())
        {
            return $validator->errors();
        }

        return validationController::checkLogin_data_of_api($request);

    }

}
