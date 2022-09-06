@extends('layouts.master')

@section('content')
@Guest

@else
@if(Auth::user()->access_level == "MOH")
<a href="{{route('index')}}/register" class="btn btn-primary">New User</a>
@endif
@endguest
<hr><?php $numbers = 1; ?>

<table id='datatable' class="table table-striped table-hover table-bordered table-hover table-responsive-md" style="width:100%">
<thead>
  <tr>
    <th>#</th>
    <th>Names</th>
    <th>Username</th>
    <th>Access Level</th>
    <th>County</th>
    <th>Sub county</th>
    <th>Email</th>
    <th>Phone number</th>
  </tr>
</thead>
<tbody>
  @foreach($users as $user)
  <tr>
    <td>{{ $numbers++ }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->access_level }}</td>
    @if($user->county)
    <td>{{ $user->county->name }}</td>
    <td></td>
    @elseif($user->subcounty)
    <td>{{ $user->subcounty->county->name }}</td>
    <td>{{ $user->subcounty->name }}</td>
    @else
    <td></td>
    <td></td>
    @endif
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile }}</td>
  </tr>
  @endforeach
  <tbody>
</table>
@endsection
