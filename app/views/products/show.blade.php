@extends('products.layout')
@section('title')
Product
@stop
@section('content')
<div id="images">
  <ul>
    @foreach($images as $image)
      <li>{{ HTML::image(asset($image->thumb)) }}</li>
    @endforeach
</ul>
</div>
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
<p>{{ link_to('products/', 'Back to Products') }}</p>
@stop
