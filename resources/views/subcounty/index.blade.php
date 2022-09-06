@extends('layouts.master')

@section('content')
@Guest

@else
@if(Auth::user()->access_level == "MOH" || Auth::user()->access_level == "County Administrator")
<a href="{{route('index')}}/subcounty/create" class="btn btn-primary">New Sub-County</a>
@endif
@endguest
<hr>

<table id='datatable' class="table table-striped table-hover table-bordered table-hover" style="width:100%">
<thead>
  <tr>
    <th></th>
    <th>SubCounty</th>
    <th>County</th>
    <th>#</th>
  </tr>
</thead>
<tbody>
  @foreach($subcounties as $subcounty)
  <tr>
    <td>{{ $number++ }}</td>
    <td>{{ $subcounty->name }}</td>
    <td>{{ $subcounty->county->name }}</td>
    <td></td>
  </tr>
  @endforeach
</tbody>
</table>
@endsection
