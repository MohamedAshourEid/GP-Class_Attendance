<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name','price','details','created_at','updated_at'];
    protected $hidden=['created_at','updated_at']; //this we use if we want to get attributes from
                                                  //specific table and want need to ignore some attribute
                                                  //so we put them in hidden array to ignore them
    //if i have timetamps in my table and i not add them by default laravel add the current time
    //so to prevent this i will do this action=>
    public $timestamps=false;

}
