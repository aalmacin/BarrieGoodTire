@extends('products.layout')
@section('title')
Create Product
@stop
@section('content')

  <div class="col-sm-offset-8 col-sm-12">
    <p>{{ link_to('products/', 'Back to Products') }}</p>
  </div>
  @include('includes.admin.products.product_form', array('product' => $product, 'rim_data' => $rim_data, 'tire_data' => $tire_data, 'type' => 'Create'))
@stop
