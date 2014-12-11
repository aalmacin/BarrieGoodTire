@extends('admin.layout')
@section('title')
Admin Page
@stop
@section('additional_nav')
  @if(Auth::user()->role == 'accounting' || Auth::user()->role == 'admin')
    <li role="presentation">{{ link_to('products', 'Products') }}</li>
  @endif
@stop
@section('content')
  @include('includes.admin.products.tires', array('tires' => $tires, 'admin' => false))
  @include('includes.admin.products.rims', array('rims' => $rims, 'admin' => false))
@stop
