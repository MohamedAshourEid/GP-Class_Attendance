<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['id', 'Fname','Lname', 'email', 'password'];

    public $timestamps = false;

    public function search($id,$email){
        return Student::query()
            ->where('id', '=', "{$id}")
            ->orWhere('email', '=', "{$email}")
            ->get();
    }

    public function store($id,$Fname,$Lname,$email,$password){
        Student::create([
            'id'=>$id,
            'Fname'=>$Fname,
            'Lname'=>$Lname,
            'email'=>$email,
            'password'=>Hash::make($password)
        ]);

    }

    public function search_logIn($id,$password){
        return Student::query()
            ->where('id', '=', "{$id}")
            ->where('password', '=', "{$password}")
            ->get();
    }



}
