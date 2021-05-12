<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    public static function search(Request $request){
        return Student::query()
            ->where('id', '=', $request->id)
            ->orWhere('email', '=', $request->email)
            ->get();
    }

    public static function store(Request $request){
        if(Student::create([
            'student_id'=>$request->id,
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
    public static function validate(Request $request){
        return Student::query()
            ->where('id', '=', $request->id)
            ->where('password', '=', $request->password)
            ->get();
    }
}
