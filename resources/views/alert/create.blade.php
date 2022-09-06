@extends('layouts.master')

@section('content')

<h1>Create an alert</h1>
<hr>
<form method="POST" action="{{route('index')}}/alert/store">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="facility_id">Facility</label>
    <select class="form-control" name="facility_id" id="facility_id">
      @foreach($facilities as $facility):
      <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
      @endforeach

    </select>
  </div>
  <div class="form-group">
    <label for="disease_id">Disease: </label>
    <select class="form-control" name="disease_id" id="disease_id">
      @foreach($diseases as $disease):
      <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
      @endforeach

    </select>
  </div>

  <div class="form-group">
    <label for="title">Age</label>
    <input type="text" class="form-control" id="age" name="age" placeholder="Enter age of the patient">
  </div>

  <div class="form-group">
    <label for="sex">Sex: </label>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="sex" id="Male" value="Male">
  <label class="form-check-label" for="Male">Male</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="sex" id="Female" value="Female">
  <label class="form-check-label" for="Female">Female</label>
</div>
  </div>

  <div class="form-group">
    <label for="status">Status: </label>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="status" id="Dead" value="Dead">
  <label class="form-check-label" for="Dead">Dead</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="status" id="Alive" value="Alive">
  <label class="form-check-label" for="Alive">Alive</label>
</div>
  </div>

  <button type="submit" class="btn btn-primary">Create alert</button>
</form>
@include('layouts.errors')
@endsection
