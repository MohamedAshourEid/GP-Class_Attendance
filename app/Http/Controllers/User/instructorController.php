<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class instructorController extends Controller
{
    //check if this account is exist or not
    public static function search(Request $request){
        return Instructor::query()
            ->where('id', '=', $request->id)
            ->orWhere('email', '=', $request->email)
            ->get();
    }

    public static function validate_data(Request $request){
        return Instructor::where([['id','=',$request->id]])->first();
    }

    public static function store(Request $request){
        if(Instructor::create([
            'id'=>$request->id,
            'Fname'=>$request->first_name,
            'Lname'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]))
        {
            return true;
        }
        return false;
    }
}
