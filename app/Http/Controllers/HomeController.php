<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\County;
use App\Models\Facility;
use App\Models\Disease;
use App\Models\Kemriresponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',["except"=>['index','getalerts']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if(Auth::check()){

            if(Auth::user()->access_level == "County Administrator"){

              $county = Auth::user()->county_id;
                $dataz=$this->charts_all_data(Disease::with(['facility', 'alerts'])->whereHas('facility', function($q) use($county) { $q->where('county_id', '=', $county); })->get());

            }
            elseif(Auth::user()->access_level == "Sub-County Administrator"){
              $subcounty = Auth::user()->subcounty_id;
              //dd($subcounty);
                $dataz=$this->charts_all_data(Disease::with(['alerts', 'facility'])->whereHas('facility', function($q) use($subcounty) { $q->where('subcounty_id', '=', $subcounty); })->get());
            }
          else{

          $dataz=$this->charts_all_data(Disease::get());
          }

        }
        else{

        $dataz=$this->charts_all_data(Disease::get());

        }

        //return view('home',compact("alerts","diseasez","Positive","Negative","Undetermined","Not_done"));
        return view("home",$dataz);
    }

    public function access_restricted(){
      return view("access_restricted");
    }

    public function getalerts(){
      if(Auth::user()){
       if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){
         $alerts = DB::table('alerts')->join('facilities','alerts.facility_id','=','facilities.id')
                 ->select(DB::raw('facilities.facility_name,facilities.latitude,facilities.longitude,alerts.facility_id,count(alerts.id) as Total'))
                 ->groupBy('alerts.facility_id','facilities.id')
                 ->get();
       }
       elseif(Auth::user()->access_level == "County Administrator"){

           //$alerts = Facility::with("alerts")->where("county_id",Auth::user()->county_id)->get();
         $alerts = DB::table('alerts')->join('facilities','alerts.facility_id','=','facilities.id')
                 ->select(DB::raw('facilities.facility_name,facilities.latitude,facilities.longitude,alerts.facility_id,count(alerts.id) as Total'))
                 ->where('facilities.county_id', '=', Auth::user()->county_id)
                 ->groupBy('alerts.facility_id','facilities.id')
                 ->get();
       }
       elseif(Auth::user()->access_level == "Sub-County Administrator"){

         $alerts = DB::table('alerts')->join('facilities','alerts.facility_id','=','facilities.id')
                 ->select(DB::raw('facilities.facility_name,facilities.latitude,facilities.longitude,alerts.facility_id,count(alerts.id) as Total'))
                 ->where('facilities.subcounty_id', '=', Auth::user()->subcounty_id)
                 ->groupBy('alerts.facility_id','facilities.id')
                 ->get();

       }
      }else{
      //$alerts = Alert::with("facility")->distinct()->get(['facility_id']);
      $alerts = DB::table('alerts')->join('facilities','alerts.facility_id','=','facilities.id')
              ->select(DB::raw('facilities.facility_name,facilities.latitude,facilities.longitude,alerts.facility_id,count(alerts.id) as Total'))
              ->groupBy('alerts.facility_id','facilities.id')
              ->get();
      }
      return $alerts;
    }

    private static function charts_all_data($alerts){
      //$alerts = Disease::get();
      $Positive=$Total_disease=$diseasez=$Negative=$Undetermined=$Not_done= array();
      //dd($alerts);
      $count=0;

      foreach($alerts as $alertz){
        $Total_disease[$count]=$alertz->alerts->count();
        //dd($Total_disease);
        $diseasez[$count]=$alertz->disease_name;

      foreach($alertz->kemri as $alert):
      @$Positive[$count]=$Positive[$count]+0;
      @$Negative[$count]=$Negative[$count]+0;
      @$Undetermined[$count]=$Undetermined[$count]+0;
      @$Not_done[$count]=$Not_done[$count]+0;

      if(isset($alert->specimen_results)){

      if($alert->specimen_results == "Positive"){
      @$Positive[$count]=$Positive[$count]+1;

      }
      if($alert->specimen_results == "Negative"){
      @$Negative[$count]=$Negative[$count]+1;

      }

      if($alert->specimen_results == "Indeterminate"){
        @$Undetermined[$count]=$Undetermined[$count]+1;

        }


        if($alert->specimen_results == "Not Done"){
          @$Not_done[$count]=$Not_done[$count]+1;

          }


      }else{
      dd("this");
      }
      endforeach;

      $count++;
      }
      return compact("alerts","Total_disease","diseasez","Positive","Negative","Undetermined","Not_done");
    }

  //  private static function charts_all_data_by_county(){



}
