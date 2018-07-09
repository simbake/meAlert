<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
use App\Alert;
use App\County;
use App\Subcounty;
use App\Response;

class ResponsesExport implements FromView
{
  use Exportable;

  public function view(): View
    {
      if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){

       $responses = Alert::with('respond')->latest()->get();

      }
      elseif(Auth::user()->access_level == "County Administrator"){
       $responses = County::find(Auth::user()->county_id)->alerts;
      }
      else if(Auth::user()->access_level == "Sub-County Administrator"){
       $responses = Subcounty::find(Auth::user()->subcounty_id)->alerts;
      }
      $counterz=1;
        return view('export.response',compact("responses","counterz"));
    }
}
