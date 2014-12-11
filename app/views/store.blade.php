@extends('layout')
@section('title')
Store
@stop
@section('content')
  @include('includes.store.categories', array('products' => $products))
@stop
