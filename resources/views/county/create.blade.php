@extends('layouts.master')

@section('content')
<div class="container">
<h1>Add a County</h1>
<hr>
<form method="POST" action="{{route('index')}}/county/store">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="title">County name: </label>
    <input type="text" required class="form-control" id="name" name="name" placeholder="County name">
  </div>
  <button type="submit" class="btn btn-primary">Add County</button>
</form>
</div>
@include('layouts.errors')
@endsection
