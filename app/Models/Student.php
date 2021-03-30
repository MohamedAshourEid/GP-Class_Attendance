<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    protected $fillable = ['id', 'Fname','Lname', 'email', 'password'];

    public $timestamps = false;

    public function search($id,$email){
        Student::query()
            ->where('id', 'like', "%{$id}%")
            ->orWhere('email', 'like', "%{$email}%")
            ->get();
    }

}
