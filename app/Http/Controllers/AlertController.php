<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Disease;
use App\Models\Alert;
use Carbon\Carbon;
use App\Models\Response;
use App\Models\County;
use App\Models\Subcounty;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\AlertsExport;
use App\Mail\AlertEmail;
use App\Models\User;

class AlertController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show_byFacility']]);
    }

    public function index(){
    // dd(Auth::user()->id);
    if(Auth::user()){
      if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){
          $alerts = Alert::latest()->get();
      }
    elseif(Auth::user()->access_level == "County Administrator"){
     //$alerts = Alert::with('facility','facility.subcounty','subcounty.county')->get();

      $alerts = County::find(Auth::user()->county_id)->alerts;
     //return $alerts->alerts;
     //return $alerts;
     //return $alerts->where("id",Auth::user()->county_id)->alerts()->get();
   }
   elseif(Auth::user()->access_level == "Sub-County Administrator"){

        $alerts = Subcounty::find(Auth::user()->subcounty_id)->alerts_subcounty;

   }
    }
   else{
    $alerts = Alert::latest()->get();
  }
    return view('alert.index',compact('alerts'));
    }

    public function show(Alert $alerts){
       return view('alert.index',compact('alerts'));
    }

    public function show_byFacility($facility_id){
      $alerts = Alert::where('facility_id',$facility_id)->latest()->get();
      return view('alert.index',compact('alerts'));
    }

    public function create(){

      if(Auth::user()->access_level == "County Administrator"){
         $facilities = Facility::where("county_id",Auth::user()->county_id)->orderBy('facility_name', 'ASC')->get();
      }
      else if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI" ){

        $facilities = Facility::orderBy('facility_name', 'ASC')->get();

      }
      elseif(Auth::user()->access_level == "Sub-County Administrator"){

        $facilities = Facility::where("subcounty_id",Auth::user()->subcounty_id)->orderBy('facility_name', 'ASC')->get();
      }else{
        return redirect("/access_restricted");
      }
      $diseases = Disease::get();
       return view('alert.create',compact('facilities','diseases'));
    }

    public function store(){

      $this->validate(request(),[
        'age'=>'required',
        'sex'=>'required',
        'status'=>'required',
      ]);
      $random_chars = strtoupper(substr(MD5(uniqid(rand(), 1)), 3, 11));
      //request(['alert_code'])=$random_chars;
    //  auth()->user()->publish(new Alert(request()));
      $alert = new Alert;
      $alert->facility_id = request('facility_id');
      $alert->disease_id = request('disease_id');
      $alert->user_id = auth()->id();
      $alert->age = request('age');
      $alert->sex = request('sex');
      $alert->status = request('status');
      $alert->alert_code = $random_chars;
      if($alert->save()){
        //return $alert;
        $user = User::find(1);

        //\Mail::to("simbake2009@yahoo.com")->send(new AlertEmail($user,$alert));
        //session()->flash("info","Alert code $alert->alert_code. An alert has been sent out to users.");
        session()->flash("success","Alert created successfully");
      }else{
        session()->flash("error","An Alert was not created because an error occurred");
      }
      return redirect('/alerts');

    }

    public function excel(){
    // $alerts = Alert::latest()->get();
     //Excel::loadView('alert.index', compact("alerts"))->export('xls');
     //return (new AlertsExport)->View();
     return (new AlertsExport)->download('alerts.xlsx');
    }
}
