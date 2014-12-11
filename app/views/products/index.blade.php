@extends('products.layout')
@section('title')
Products Page
@stop
@section('content')
<h2>Tires</h2>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Brand Name</th>
        <th>Description</th>
        <th>Size</th>
        <th>Model</th>
        <th>Original Price</th>
        <th>Price</th>
        <th>Show</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
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
        <td>{{ link_to('products/'.$tire['id'].'/edit/', 'Edit') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<h2>Rims</h2>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Material</th>
        <th>Size</th>
        <th>Bolt Pattern</th>
        <th>Original Price</th>
        <th>Price</th>
        <th>Show</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rims as $rim)
      <tr>
        <td>{{ $rim['quantity'] }}</td>
        <td>{{ $rim['material'] }}</td>
        <td>{{ $rim['size'] }}</td>
        <td>{{ $rim['bolt_pattern'] }}</td>
        <td>{{ $rim['original_price'] }}</td>
        <td><strong>{{ $rim['price'] }}</strong></td>
        <td>{{ link_to('products/'.$rim['id'], 'Show') }}</td>
        <td>{{ link_to('products/'.$rim['id'].'/edit/', 'Edit') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<p>{{ link_to('products/create', 'New Product') }}</p>
@stop
