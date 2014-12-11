@extends('products.layout')
@section('title')
Product
@stop
@section('content')

<div class="col-sm-offset-8 col-sm-12">
  {{ link_to('products/', 'Back to Products') }}
</div>

<div class="container-fluid">
  @include('includes.admin.products.image_thumbnails', array('images' => $images))
  <div class="col-sm-offset-2 col-sm-12">
    @if($product['type'] == 'rim')
    <h2>Rim</h2>
    <p>Quantity: {{ $product['quantity'] }}</p>
    <p>Material: {{ $product['material'] }}</p>
    <p>Size: {{ $product['size'] }}</p>
    <p>Bolt Pattern: {{ $product['bolt_pattern'] }}</p>
    <p>Original Price: {{ $product['original_price'] }}</p>
    <p><strong>Price: {{ $product['price'] }}</strong></p>
    @elseif($product['type'] == 'tire')
    <h2>Tire</h2>
    <p>Quantity: {{ $product['quantity'] }}</p>
    <p>Brand Name: {{ $product['brand_name'] }}</p>
    <p>Description: {{ $product['description'] }}</p>
    <p>Size: {{ $product['size'] }}</p>
    <p>Model: {{ $product['model'] }}</p>
    <p>Original Price: {{ $product['original_price'] }}</p>
    <p><strong>Price: {{ $product['price'] }}</strong></p>
    @endif
  </div>
</div>
@stop
