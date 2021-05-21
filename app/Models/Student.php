<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['student_id','Fname','Lname', 'email', 'password'];

    public $timestamps = false;

}
