@extends('layouts.master')

@section('content')
@Guest

@else
@if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "County Administrator")
<a href="/county/create" class="btn btn-primary">New County</a>
@endif
@endguest
<hr>

<table id='datatable' class="table table-striped table-hover table-bordered table-hover" style="width:100%">
<thead>
  <tr>
    <th></th>
    <th>County Name</th>
    <th>#</th>
  </tr>
</thead>
<tbody>
  @foreach($counties as $county)
  <tr>
    <td>{{ $number++ }}</td>
    <td>{{ $county->name }}</td>
    <td></td>
  </tr>
  @endforeach
</tbody>
</table>
@endsection
