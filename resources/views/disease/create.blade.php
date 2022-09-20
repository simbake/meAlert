@extends('layouts.master')

@section('content')
<div class="container">
<h1>Add a Disease</h1>
<hr>
<form method="POST" action="{{route('index')}}/disease/store">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="title">Disease name: </label>
    <input type="text" class="form-control" id="disease_name" name="disease_name" placeholder="Enter Disease name">
  </div>
  <div class="form-group">
    <label for="title">Disease acronym: </label>
    <input type="text" class="form-control" id="disease_acronym" name="disease_acronym" placeholder="Enter Disease acronym">
  </div>
  <div class="form-group">
    <label for="body">Case definition: </label>
      <textarea class="form-control" id="case_definition" name="case_definition" rows="3"></textarea>
   </div>
   <div class="form-group">
     <label for="body">Case lab sample handling: </label>
       <textarea class="form-control" id="lab_sample_handling" name="lab_sample_handling" rows="3"></textarea>
    </div>
  <button type="submit" class="btn btn-primary">Add Disease</button>
</form>
</div>
@include('layouts.errors')
@endsection
