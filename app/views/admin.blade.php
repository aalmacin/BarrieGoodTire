@extends('layout')
@section('title')
Admin Page
@stop
@section('content')
<a href="{{ URL::to('logout') }}">Logout</a>
@if(Auth::user()->role == 'reader')
<h1>Reader</h1>
@elseif(Auth::user()->role == 'accounting')
<h1>Accounting</h1>
@elseif(Auth::user()->role == 'admin')
<h1>Admin</h1>
@endif
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
  </tr>
  @foreach($rims as $rim)
  <tr>
    <td>{{ $rim['quantity'] }}</td>
    <td>{{ $rim['material'] }}</td>
    <td>{{ $rim['size'] }}</td>
    <td>{{ $rim['bolt_pattern'] }}</td>
    <td>{{ $rim['original_price'] }}</td>
    <td><strong>{{ $rim['price'] }}</strong></td>
  </tr>
  @endforeach
</table>
@stop
