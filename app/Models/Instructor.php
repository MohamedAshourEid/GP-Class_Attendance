<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = "instructors";
    protected $fillable = ['id', 'Fname','Lname', 'email', 'password'];

    public $timestamps = false;
}
