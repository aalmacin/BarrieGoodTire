@extends('products.layout')
@section('title')
Products Page
@stop
@section('content')
<h2>Tires</h2>
<table>
  <tr>
    <th>Quantity</th>
    <th>Brand Name</th>
    <th>Description</th>
    <th>Size</th>
    <th>Model</th>
    <th>Original Price</th>
    <th>Price</th>
    <th>Show</th>
  </tr>
  @foreach($tires as $tire)
  <tr>
    <td>{{ $tire['quantity'] }}</td>
    <td>{{ $tire['brand_name'] }}</td>
    <td>{{ $tire['description'] }}</td>
    <td>{{ $tire['size'] }}</td>
    <td>{{ $tire['model'] }}</td>
    <td>{{ $tire['original_price'] }}</td>
    <td><strong>{{ $tire['price'] }}</strong></td>
    <td>{{ link_to('products/'.$tire['id'], 'Show') }}</td>
  </tr>
  @endforeach
</table>
<h2>Rims</h2>
<table>
  <tr>
    <th>Quantity</th>
    <th>Material</th>
    <th>Size</th>
    <th>Bolt Pattern</th>
    <th>Original Price</th>
    <th>Price</th>
    <th>Show</th>
  </tr>
  @foreach($rims as $rim)
  <tr>
    <td>{{ $rim['quantity'] }}</td>
    <td>{{ $rim['material'] }}</td>
    <td>{{ $rim['size'] }}</td>
    <td>{{ $rim['bolt_pattern'] }}</td>
    <td>{{ $rim['original_price'] }}</td>
    <td><strong>{{ $rim['price'] }}</strong></td>
    <td>{{ link_to('products/'.$rim['id'], 'Show') }}</td>
  </tr>
  @endforeach
</table>

<p>{{ link_to('products/create', 'New Product') }}</p>
@stop
