@extends('layout')
@section('title')
Admin Page
@stop
@section('content')
<h1>Admin</h1>
<a href="{{ URL::to('logout') }}">Logout</a>
@stop
