<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table="announce";
    protected $fillable=['id','course_id','body'];

    public $timestamps=false;

}
