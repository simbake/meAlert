<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
use App\Alert;
use App\County;
use App\Subcounty;

class AlertsExport implements FromView
{
  use Exportable;

  public function view(): View
    {
      if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "KEMRI"){
          $alerts = Alert::latest()->get();
      }
    elseif(Auth::user()->access_level == "County Administrator"){

      $alerts = County::find(Auth::user()->county_id)->alerts;

   }

   elseif(Auth::user()->access_level == "Sub-County Administrator"){

        $alerts = Subcounty::find(Auth::user()->subcounty_id)->alerts_subcounty;

   }
        return view('export.alert',compact("alerts"));
    }
}
