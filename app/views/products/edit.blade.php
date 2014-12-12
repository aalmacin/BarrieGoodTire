@extends('products.layout')
@section('title')
Edit Product
@stop
@section('content')

<div class="col-sm-offset-8 col-sm-2">
  {{ link_to('products/', 'Back to Products') }}
</div>

@include('includes.admin.products.product_form', array('product' => $product, 'rim_data' => $rim_data, 'tire_data' => $tire_data, 'type' => 'Edit'))

{{ Form::open(array('url' => 'products/' . $product['id'], 'role' => 'form', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-4">
      {{ Form::hidden('_method', 'DELETE') }}
      {{ Form::submit('Delete Product', array('class'=>'form-control', 'class'=>'btn btn-danger', 'onclick' => "if(!confirm('Are you sure to delete this item?')){return false;};")) }}
    </div>
  </div>
{{ Form::close() }}

@stop
