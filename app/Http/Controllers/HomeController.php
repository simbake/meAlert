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
              $alerts = DB::table("facilities")
                        ->join('alerts','alerts.facility_id','=','facilities.id')
                        ->join('diseases','alerts.disease_id','=','diseases.id')
                        ->leftJoin('Kemriresponses','Kemriresponses.alert_id','=','alerts.id')
                        ->select(DB::raw('diseases.disease_name,count(alerts.id) as Total,count(Kemriresponses.alert_id) as total_results'))
                        ->where('facilities.county_id', '=', Auth::user()->county_id)
                        ->groupBy('alerts.disease_id','diseases.id')
                        ->get();

            }
            elseif(Auth::user()->access_level == "Sub-County Administrator"){
              $alerts = DB::table("facilities")
                        ->join('alerts','alerts.facility_id','=','facilities.id')
                        ->join('diseases','alerts.disease_id','=','diseases.id')
                        ->leftJoin('Kemriresponses','Kemriresponses.alert_id','=','alerts.id')
                        ->select(DB::raw('diseases.disease_name,count(alerts.id) as Total, count(Kemriresponses.alert_id) as total_results'))
                        ->where('facilities.subcounty_id', '=', Auth::user()->subcounty_id)
                        ->groupBy('alerts.disease_id','diseases.id')
                        ->get();
            }
          else{
            //HomeController::charts_all_data();
          $dataz=$this->charts_all_data();
          }

        }
        else{

        $dataz=$this->charts_all_data();

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

    public static function charts_all_data(){
      $alerts = Disease::get();
      $Positive=$Negative=$Undetermined=$Not_done= array();
      $count=0;

      foreach($alerts as $alertz){
        $Total_disease[$count]=$alertz->alerts->count();
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

      $count=$count+1;
      }
      return compact("alerts","Total_disease","diseasez","Positive","Negative","Undetermined","Not_done");
    }
}
