<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $table = "quiz";
    protected $fillable = ['id','courseID','topic'];

    public $timestamps=false;
    public $incrementing = false;
}
