@extends('layouts.master')

@section('content')
@Guest

@else
<a href="{{route('index')}}/responses/excel" style="float:right" class="btn btn-primary">Export to Excel</a>
@endguest
<br/><hr>
<?php $show_right = 0; ?>
<table class="table table-striped table-hover table-bordered table-hover table-responsive" id='datatable' style="width:100%">
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
    <th>National Response</th>
    <th>County Response</th>
    <th>Sub-County Response</th>
    <th>KEMRI Response</th>
  </tr>
</thead>
<tbody> <?php $counterz = 1; ?>
  @foreach($responses as $response)
  <tr>
    <?php //echo gettype($alert->respond); exit;?>
    <td>{{ $response->alert_code }}</td>
    <td>{{ $response->facility->facility_name }}</td>
    <td>{{ $response->disease->disease_name }}</td>
    <td>{{ $response->age }}</td>
    <td>{{ $response->sex }}</td>
    <td>{{ $response->status }}</td>
    <td>{{ $response->user->name }}</td>
    <td>{{ $response->created_at->toDayDateTimeString() }}</td>
    <td>
      @if(@$response->respond->national == NULL)
        No Response
      @else
      {!! $response->respond->national !!}
      @endif
    </td>
    <td>
      @if(@$response->respond->county == NULL)
        No Response
      @else
        {!! $response->respond->county !!}
      @endif
    </td>
    <td>
      @if(@$response->respond->subcounty == NULL)
        No Response
      @else
        {!! $response->respond->subcounty !!}
      @endif
    </td>
    <?php $kemri = $response->kemri ?>
     @if($kemri)
     <td>{{$kemri['specimen_results']}}</td>
     @else
     <td>No Response</td>
      @endif
</tr>
  @endforeach
</tbody>
</table>
@endsection
