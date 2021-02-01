<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table="doctors";
    protected $fillable=['id','full_name','email','password'];

    public $timestamps=false;
}
