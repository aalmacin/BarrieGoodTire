@extends('products.layout')
@section('title')
Products Page
@stop
@section('content')
@include('includes.admin.products.tires', array('tires' => $tires, 'admin' => true))
@include('includes.admin.products.rims', array('rims' => $rims, 'admin' => true))

<p>{{ link_to('products/create', 'New Product') }}</p>
@stop
