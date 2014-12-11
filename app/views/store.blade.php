@extends('layout')
@section('title')
Store
@stop
@section('content')
  @if($all_results)
    @include('includes.store.tires', array('products' => $products))
  @endif
@stop
