@extends('layout')
@section('title')
Buy cheap quality used tires and car parts
@stop
@section('description')
The best place to buy cheap but quality used tires and car parts in Barrie.
We have tons of different car sizes available. All are branded and almost as good as brand new.
@stop
@section('content')
  @include('includes.store.categories', array('products' => $products))
@stop
