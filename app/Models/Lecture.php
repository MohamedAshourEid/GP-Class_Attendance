<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table='lectures';
    protected $fillable=['id','course_id'];
    public $timestamps=false;
}
