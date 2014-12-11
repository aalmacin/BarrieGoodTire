@extends('layout')
@section('title')
Product Details
@stop
@section('content')

<div class="col-sm-offset-7 col-sm-2">
  {{ link_to('store/', 'Back to Store') }}
</div>

<div class="container-fluid">
  @include('includes.admin.products.image_thumbnails', array('images' => $images))
  <div class="col-sm-offset-2 col-sm-9">
    @if($product['type'] == 'rim')
    <h2>Rim</h2>
    <p>Material: {{ $product['material'] }}</p>
    <p>Size: {{ $product['size'] }}</p>
    <p>Bolt Pattern: {{ $product['bolt_pattern'] }}</p>
    <p><strong>Price: {{ $product['price'] }}</strong></p>
    @elseif($product['type'] == 'tire')
    <h2>Tire</h2>
    <p>Brand Name: {{ $product['brand_name'] }}</p>
    <p>Description: {{ $product['description'] }}</p>
    <p>Size: {{ $product['size'] }}</p>
    <p>Model: {{ $product['model'] }}</p>
    <p><strong>Price: {{ $product['price'] }}</strong></p>
    @endif
  </div>
</div>
@stop
