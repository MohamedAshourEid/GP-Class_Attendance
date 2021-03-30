<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRegistration extends Controller
{
    //
    public function signup()
    {
        $validator=validationController::validata_up($request);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        validationController::insertInDatabase($request);
        return redirect()->back()->with(['success'=>'Signed Up Successfully']);
    }
}
