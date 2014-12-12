@extends('layout')
@section('title')
Used car parts and tires store
@stop
@section('description')
Store page that let's you search for the best car parts or tires for your vehicles.
Browse our huge selection of tires and car parts. All parts and tires are cheap and in good quality.
@stop
@section('content')
  @include('includes.store.categories', array('products' => $products))
@stop
