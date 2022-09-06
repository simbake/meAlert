<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Carbon\Carbon;
use App\Models\County;
use App\Models\Subcounty;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }
    public function index(){
      $numbers=1;
      if(Auth::user()){
      if(Auth::user()->access_level == "County Administrator"){
         $facilities = Facility::where("county_id",Auth::user()->county_id)->latest()->get();
      }
      else if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI" ){

        $facilities = Facility::latest()->get();

      }
      elseif(Auth::user()->access_level == "Sub-County Administrator"){

        $facilities = Facility::where("subcounty_id",Auth::user()->subcounty_id)->get();
      }
    }else{
      $facilities = Facility::latest()->get();
    }

      return view('facility.index',compact('facilities','numbers'));
    }
    public function show(){

    }

    public function create(){

      if(Auth::user()->access_level == "MOH"){
      $subcounties = Subcounty::orderBy('name', 'ASC')->get();
    }elseif(Auth::user()->access_level == "County Administrator"){
      $subcounties = Subcounty::where("county_id",Auth::user()->county_id)->orderBy('name', 'ASC')->get();
    }elseif(Auth::user()->access_level == "Sub-County Administrator"){
      $subcounties = Subcounty::where("id",Auth::user()->subcounty_id)->orderBy('name', 'ASC')->get();
    }else{
      return redirect("/access_restricted");
    }
      return view('facility.create',compact('subcounties'));
    }

    public function store(){

      $this->validate(request(),[
        'facility_code'=>'required',
        'facility_name'=>'required',
        'sub_county'=>'required',
        'type'=>'required',
        'phone_no'=>'required',
        'latitude'=>'required',
        'longitude'=>'required'
      ]);
      $county = Subcounty::where("id",request('sub_county'))->first();
      //return request('sub_county')."->".$county->county_id;
      $facility = new Facility;
      $facility->facility_code = request('facility_code');
      $facility->facility_name = request('facility_name');
      $facility->county_id = $county->county_id;
      $facility->subcounty_id = request('sub_county');
      $facility->type = request('type');
      $facility->phone_no = request('phone_no');
      $facility->latitude = request('latitude');
      $facility->longitude = request('longitude');
      //$facility->save();
      if($facility->save()){
        session()->flash("success","Facility ".request('facility_name')." created successfully");
      }else{
        session()->flash("error","Facility ".request('facility_name')." was not created because an error occurred");
      }
      return redirect('/facility/create');
    }
}
