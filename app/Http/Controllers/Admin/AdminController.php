<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class AdminController extends Controller
{
    /**
     * @return string
     */
    public function showString(){
        return 'static string';
    }
    public function showIndex(){
        $data=[];
        $data['id']=20170166;
        $data['name']='alaa ebrahim';
        $data['age']=21;
        return view('welcome')->with('data',$data);
    }
}
