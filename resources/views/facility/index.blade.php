@extends('layouts.master')

@section('content')
@Guest

@else
@if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "County Administrator" || Auth::user()->access_level == "Sub-County Administrator")
<a href="/facility/create" class="btn btn-primary">New Facility</a>
@endif
@endguest
<hr>

<table id='datatable' class="table table-striped table-hover table-bordered table-hover table-responsive" style="width:100%">
<thead>
  <tr>
    <th>#</th>
    <th>Facility code</th>
    <th>Facility name</th>
    <th>County</th>
    <th>Sub county</th>
    <th>Type</th>
    <th>Phone number</th>
  </tr>
</thead>
<tbody>
  @foreach($facilities as $facility)
  <tr>
    <td>{{ $numbers++ }}</td>
    <td>{{ $facility->facility_code }}</td>
    <td>{{ $facility->facility_name }}</td>
    <td>{{ $facility->subcounty->county->name }}</td>
    <td>{{ $facility->subcounty->name }}</td>
    <td>{{ $facility->type }}</td>
    <td>{{ $facility->phone_no }}</td>
  </tr>
  @endforeach
  <tbody>
</table>
@endsection
