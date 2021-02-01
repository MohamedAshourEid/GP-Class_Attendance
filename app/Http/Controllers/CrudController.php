<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOffers()
    {
        return Offer::select('name', 'price')->get();
    }

    //to add in database
    /*public function store(){
        Offer::create([
            'name'=>'offer2',
            'price'=>'500',
            'details'=>'offer details'
        ]);
    }*/
    public function create()
    {
        return view('offers.create');
    }

    public function store(Request $request)
    {
        //validate data before inserting in database
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details
        ]);
        return redirect()->back()->with(['success'=>'Offer saved successfully']);
        //return 'saved successfully';
    }

    protected function getRules()
    {
        return $rules = [
            'name' => 'required|max:255|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }
    protected function getMessages(){
        return $messages=[
        'name.required'=>'اسم العرض مطلوب',
        'name.unique' => 'اسم العرض موجود',
        'price.required' => 'السعر مطلوب',
        'price.numeric' => 'السعر لازم يكون ارقام',
        ] ;
    }

}
