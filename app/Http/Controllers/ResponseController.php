<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alert;
use App\Response;
use Illuminate\Support\Facades\Auth;
use App\Kemriresponse;
use App\County;
use App\Subcounty;
use App\Exports\ResponsesExport;
use Carbon\Carbon;
use App\Mail\KemriEmail;
use App\User;
//use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }
    public function index(){

      if(Auth::user()){

        if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){

         $responses = Alert::with('respond')->latest()->get();

        }
        elseif(Auth::user()->access_level == "County Administrator"){
         $responses = County::find(Auth::user()->county_id)->alerts;
        }
        else if(Auth::user()->access_level == "Sub-County Administrator"){
         $responses = Subcounty::find(Auth::user()->subcounty_id)->alerts;
        }

      }else{
        $responses = Alert::with('respond')->latest()->get();
      }//return $responses;
        return view('response.index',compact('responses'));

    }


    public function response(Alert $alert){

      return view('response.create',compact('alert'));

    }

    public function store($response){

        $responses = "";
        $action_taken = request('phone_call')." ".request('visited')." ".request('sample_taken')." ".request('investigations_made')." ".request('public_health_action_taken');
        $responses =$responses."<strong>Action Taken:</strong> ".$action_taken."<br/>";
        if(request('public_health_action_taken') == "Public Health Action Taken"){
        $responses = $responses."<Strong>Public Action Taken:</strong> ".request('public_action')."<br/>";
        if(request('public_action') == 'Other'){
          $responses = $responses."<strong>Public Action Other:</strong> ".request("other_public_action")."<br/>";
        }
      }
        $responses = $responses."<strong>Findings:</strong> ".request("findings")."<br/>";
        if(request("findings") == "Other"){
          $responses = $responses."<strong>Other Findings:</strong> ".request("other_findings")."<br/>";
        }
        $responses = $responses."<strong>Comments:</strong> ".request("comments")."<br/>";
        $responses = $responses."<strong>Created By:</strong> ".Auth::user()->name."<br/>";
        $responses = $responses."<strong>On:</strong> ".Carbon::now()->toDayDateTimeString();
        $check_response = Response::where('id',$response)->get();
        if($check_response->count()){
          $db = Response::find($response);
          if(Auth::user()->access_level == "MOH"){
            $db->national = $responses;
          }elseif(Auth::user()->access_level == "County Administrator"){
            $db->county = $responses;
          }else if(Auth::user()->access_level == "Sub-County Administrator"){
            $db->subcounty = $responses;
          }
          $db->save();
          if($db->save()){
            session()->flash("success","Response for alert ".request("alert_code").", created successfully");
          }else{
            session()->flash("error","The response for alert ".request("alert_code").", was not created because an error occurred");
          }
        }else{
          //echo "save";
          $db = new Response;
          $db->alert_id = $response;
          $db->user_id = auth()->id();
          if(Auth::user()->access_level == "MOH"){
            $db->national = $responses;
          }else if(Auth::user()->access_level == "County Administrator"){
            $db->county = $responses;
          }else if(Auth::user()->access_level == "Sub-County Administrator"){
            $db->subcounty = $responses;
          }
          $db->save();
          if($db->save()){
            session()->flash("success","Response for alert ".request("alert_code").", created successfully");
          }else{
            session()->flash("error","The response for alert ".request("alert_code").", was not created because an error occurred");
          }
        }
        //return $responses;
        //dd($action_taken);
      /* $responses = new Response;
       $responses->alert_id = $response;
       $responses->user_id = auth()->id();
       $responses->type = Auth::user()->access_level;
       $responses->action_taken = $action_taken;
       if(request('public_health_action_taken') == "Public Health Action Taken"){
         $responses->public_action_taken = request('public_action');
         if(request('public_action') == 'Other'){
           $responses->other_public_action_taken = request("other_public_action");
         }
         else{
           $responses->other_public_action_taken="";
         }
       }
       else{
         $responses->public_action_taken = "";
         $responses->other_public_action_taken="";
       }
       $responses->findings = request("findings");
       if(request("findings") == "Other"){
         $responses->other_findings = request("other_findings");
       }
       else{
         $responses->other_findings = "";
       }
       $responses->comments = request("comments");
       //$responses->save();
       if($responses->save()){
         session()->flash("success","Response created successfully");
       }else{
         session()->flash("error","A response was not created because an error occurred");
       }*/
       return redirect('/alerts');
    }
    public function kemri_response(Alert $alert){
      $kemri_access = Auth::user()->access_level;
      if($kemri_access == "KEMRI"){
      return view("kemri.create",compact('alert'));
          }
          else{
            return redirect('/access_restricted');
          }
    }

    public function kemri_response_store($alert){

      $this->validate(request(),[
        'specimen_received'=>'required|date',
        'specimen_type'=>'required',
        'condition'=>'required',
        'results'=>'required'
      ]);
      $kemri = new Kemriresponse;
      $kemri->alert_id = $alert;
      $kemri->specimen_received = request("specimen_received");
      $kemri->specimen_type = request("specimen_type");
      if(request("specimen_type") == "Other"){
        $kemri->specimen_type_other = request("specimen_type_other");
      }else{
        $kemri->specimen_type_other = "";
      }
      $kemri->specimen_condition = request("condition");
      if(request("condition") == "Other"){
        $kemri->specimen_condition_other = request("other_condition");
      }else{
        $kemri->specimen_condition_other = "";
      }
      $kemri->specimen_results = request("results");
      $kemri->comments = request("comments");
      //$kemri->save();
      if($kemri->save()){
        $user = User::find(1);
        $alerts = Alert::find($alert);
        \Mail::to("simbake2009@yahoo.com")->send(new KemriEmail($user,$alerts,$kemri));
        session()->flash("success","Response created successfully");
      }else{
        session()->flash("error","Response was not created because an error occurred");
      }
      return redirect("/alerts");
    }

    public function excel(){
    // $alerts = Alert::latest()->get();
     //Excel::loadView('alert.index', compact("alerts"))->export('xls');
     //return (new AlertsExport)->View();
     return (new ResponsesExport)->download('responses.xlsx');
    }
}
