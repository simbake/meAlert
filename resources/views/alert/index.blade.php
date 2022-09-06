@extends('layouts.master')

@section('content')
@auth
@if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "County Administrator" || Auth::user()->access_level == "Sub-County Administrator")
<a href="{{route('index')}}/alert/create" class="btn btn-primary">New Alert</a>
@endif
<a href="{{route('index')}}/alert/excel" style="float:right" class="btn btn-primary">Export to Excel</a>
@endauth
<hr>

<table class="table table-striped table-hover table-bordered table-hover table-responsive-md" id='datatable' style="width:100%">
  <thead>
  <tr>
    <th>Alert Code</th>
    <th>Facility Reported</th>
    <th>Disease Reported</th>
    <th>Patient Age</th>
    <th>Patient Sex</th>
    <th>Patient Status</th>
    <th>Reported By</th>
    <th>Reported On</th>
    <th>#</th>
  </tr>
</thead>
<tbody>
  @foreach($alerts as $alert)
  <tr>
    <?php //echo gettype($alert->respond); exit;?>
    <td>{{ $alert->alert_code }}</td>
    <td>{{ $alert->facility->facility_name }}</td>
    <td>{{ $alert->disease->disease_name }}</td>
    <td>{{ $alert->age }}</td>
    <td>{{ $alert->sex }}</td>
    <td>{{ $alert->status }}</td>
    <td>{{ $alert->user->name }}</td>
    <td>{{ $alert->created_at->toDayDateTimeString() }}</td>
    @guest
    <td>Guest</td>
    @else
    @if(Auth::user()->access_level == "KEMRI")
    <?php
    $kemri = $alert->kemri;
      //$kemri_response = Kemriresponse::where("alert_id",$alert->id)->get()
    ?>
    @if($alert->kemri && $alert->kemri->alert_id == $alert->id)
     <td>Response already submitted</td>
    @else
    <td><a href="{{route('index')}}/kemri/create/{{ $alert->id }}" class="badge badge-primary">Respond</a></td>
    @endif

    @else
    @if(Auth::user()->access_level == "MOH" && @$alert->respond->national == NULL)
     <td><a href="{{route('index')}}/alert/response/{{ $alert->id }}" class="badge badge-primary">Respond</a></td>
     @elseif(Auth::user()->access_level == "County Administrator" && @$alert->respond->county == NULL)
     <td><a href="{{route('index')}}/alert/response/{{ $alert->id }}" class="badge badge-primary">Respond</a></td>
     @elseif(Auth::user()->access_level == "Sub-County Administrator" && @$alert->respond->subcounty == NULL)
     <td><a href="{{route('index')}}/alert/response/{{ $alert->id }}" class="badge badge-primary">Respond</a></td>
     @else
     <td>Response already submitted</td>
    @endif
    @endif
    @endguest
  </tr>
  @endforeach
</tbody>
</table>
@endsection
