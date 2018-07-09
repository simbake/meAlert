<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcounty;
use App\County;
use Illuminate\Support\Facades\Auth;

class SubcountyController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }
    public function index(){
      if(Auth::user()){
      if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){
        $subcounties = Subcounty::orderBy('name', 'ASC')->get();
      }
      elseif(Auth::user()->access_level == "County Administrator"){
       $subcounties = Subcounty::where("county_id",Auth::user()->county_id)->orderBy('name', 'ASC')->get();
      }
      elseif(Auth::user()->access_level == "Sub-County Administrator"){
        $subcounties = Subcounty::where("id",Auth::user()->subcounty_id)->orderBy('name', 'ASC')->get();
      }
      }
      else{
      $subcounties = Subcounty::orderBy('name', 'ASC')->get();
    }
      $number = 1;
      return view("subcounty.index",compact("subcounties","number"));
    }
    public function create(){
      $counties = County::orderBy('name', 'ASC')->get();
      return view('subcounty.create',compact("counties"));
    }
    public function store(){
      $this->validate(request(),[
        'name'=>'required',
        'county'=>'required'
      ]);
      $subcounty = new Subcounty;
      $subcounty->county_id = request('county');
      $subcounty->name = request('name');
      //$subcounty->save();
      if($subcounty->save()){
        session()->flash("success","Sub-County ".request("name")." created successfully");
      }else{
        session()->flash("error","Sub-County ".request("name")." was not created because an error occurred");
      }
      return redirect('/subcounty/create');
    }
}
