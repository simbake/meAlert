<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\County;
use App\Subcounty;
use Illuminate\Support\Facades\Auth;

class CountyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }
    public function index(){
      if(Auth::user()){
      if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){
      $counties = County::orderBy('name', 'ASC')->get();
      }
      elseif(Auth::user()->access_level == "County Administrator"){
        $counties = County::Where("id",Auth::user()->county_id)->orderBy('name', 'ASC')->get();
      }
      elseif(Auth::user()->access_level == "Sub-County Administrator"){
        $subcounty = Subcounty::where("id",Auth::user()->subcounty_id)->first();
        //return $subcounty->county_id;
        $counties = County::where("id",$subcounty->county_id)->get();

      }
      }else{
      $counties = County::orderBy('name', 'ASC')->get();
    }
      $number = 1;
      return view("county.index",compact("counties","number"));
    }
    public function create(){
      return view("county.create");
    }
    public function store(){
      $this->validate(request(),[
        'name'=>'required',
      ]);
      $county = new County;
      $county->name = request('name');
      
      if($county->save()){
        session()->flash("success","County ".request('name')." created successfully");
      }else{
        session()->flash("error","County".request('name')." was not created because an error occurred");
      }
      return redirect('/county/create');
    }
}
