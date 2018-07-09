@extends('layouts.master')

@section('content')

<h1>Add a County</h1>
<hr>
<form method="POST" action="/county/store">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="title">County name: </label>
    <input type="text" required class="form-control" id="name" name="name" placeholder="County name">
  </div>
  <button type="submit" class="btn btn-primary">Add County</button>
</form>
@include('layouts.errors')
@endsection
