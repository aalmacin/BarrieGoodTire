@extends('layout')
@section('title')
Admin Page
@stop
@section('content')
<a href="{{ URL::to('logout') }}">Logout</a>
@if(Auth::user()->role == 'reader')
<h1>Reader</h1>
@elseif(Auth::user()->role == 'accounting')
<h1>Accounting</h1>
@elseif(Auth::user()->role == 'admin')
<h1>Admin</h1>
@endif
@stop
