@extends('layouts.master')

@section('content')

<h1>Add a SubCounty</h1>
<hr>
<form method="POST" action="/subcounty/store">
  {{ csrf_field() }}
  <div class="form-group">

    <label for="county">County name: </label>
    <select class="form-control" name="county" id="county">
      @foreach($counties as $county):
      <option value="{{ $county->id }}">{{ $county->name }}</option>
      @endforeach

    </select>

  </div>
  <div class="form-group">
    <label for="name">Sub-County name: </label>
    <input type="text" required class="form-control" id="name" name="name" placeholder="County name">
  </div>
  <button type="submit" class="btn btn-primary">Add County</button>
</form>
@include('layouts.errors')
@endsection
