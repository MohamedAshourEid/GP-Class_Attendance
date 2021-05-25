<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class TrainingSet extends Model
{
    protected $table = "trainingset";
    protected $fillable = ['student_id','performance','attendance','fail/pass'];

    public $timestamps = false;
}
