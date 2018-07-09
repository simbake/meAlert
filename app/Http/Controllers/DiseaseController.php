<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disease;

class DiseaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }
    public function index(){
    $diseases = Disease::latest()->get();
    return view('disease.index',compact('diseases'));
    }
    public function show(){

    }
    public function create(){
       return view('disease.create');
    }
    public function store(){
      $this->validate(request(),[
        'disease_acronym'=>'required',
        'disease_name'=>'required',
        'case_definition'=>'required',
        'lab_sample_handling'=>'required'
      ]);
      $disease = new Disease;
      $disease->disease_acronym = request('disease_acronym');
      $disease->disease_name = request('disease_name');
      $disease->case_definition = request('case_definition');
      $disease->lab_sample_handling = request('lab_sample_handling');
      //$disease->save();
      if($disease->save()){
        session()->flash("success","Disease ".request('disease_name')." was created successfully");
      }else{
        session()->flash("error","Disease".request('disease_name')." was not created because an error occurred");
      }
      return redirect('/disease/create');
    }
}
