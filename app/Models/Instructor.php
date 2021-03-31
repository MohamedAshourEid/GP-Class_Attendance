<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Instructor extends Model
{
    protected $table = "instructors";
    protected $fillable = ['id', 'Fname','Lname', 'email', 'password'];

    public $timestamps = false;

    public function search($id,$email){
        return Instructor::query()
            ->where('id', '=', "{$id}")
            ->orWhere('email', '=', "{$email}")
            ->get();
    }

    public function search_logIn($id,$password){
        return Instructor::query()
            ->where('id', '=', "{$id}")
            ->where('password', '=', "{$password}")
            ->get();
    }

    public function store($id,$Fname,$Lname,$email,$password){
        Instructor::create([
            'id'=>$id,
            'Fname'=>$Fname,
            'Lname'=>$Lname,
            'email'=>$email,
            'password'=>$password
        ]);
    }

    public function getJoinedCourses(){

    }
}
