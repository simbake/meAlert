@extends('layouts.master')

@section('content')

<h1>Add a Facility</h1>
<hr>
<form method="POST" action="/facility/store">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="facility_name">Facility name: </label>
    <input type="text" class="form-control" id="facility_name" name="facility_name" placeholder="Enter Facility name">
  </div>
  <div class="form-group">
    <label for="facility_code">Facility code: </label>
    <input type="text" class="form-control" id="facility_code" name="facility_code" placeholder="Enter Facility code">
  </div>
  <div class="form-group">
    <label for="sub_county">Facility Sub-County: </label>
    <select class="form-control" name="sub_county" id="sub_county">
      @foreach($subcounties as $subcounty)
      <option value="{{ $subcounty->id }}">{{ $subcounty->name }}</option>
      @endforeach
    </select>
    </div>
  <div class="form-group">
    <label for="type">Facility type: </label>
    <input type="text" class="form-control" id="type" name="type" placeholder="Enter Facility type">
  </div>
  <div class="form-group">
    <label for="phone_no">Facility phone number: </label>
    <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Facility phone number">
  </div>
  <div class="form-group">
    <label for="latitude">Facility Latitude: </label>
    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Facility Latitude">
  </div>
  <div class="form-group">
    <label for="longitude">Facility Longitude: </label>
    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Facility Longitude">
  </div>
  <button type="submit" class="btn btn-primary">Add Facility</button>
</form>
@include('layouts.errors')
@endsection
