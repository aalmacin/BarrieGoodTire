@extends('layout')
@section('title')
Quality Tires in Barrie
@stop
@section('content')
  @include('includes.store.categories', array('products' => $products))
@stop
