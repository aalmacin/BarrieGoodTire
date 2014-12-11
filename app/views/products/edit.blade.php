@extends('products.layout')
@section('title')
Edit Product
@stop
@section('content')

<div class="col-sm-offset-8 col-sm-12">
  {{ link_to('products/', 'Back to Products') }}
</div>

{{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'files' => true, 'role' => 'form', 'class' => 'form-horizontal')) }}

  <div class="col-sm-12 container-fluid">
    @if ($errors->has())
    <div class="alert alert-danger" role="alert">
      @foreach ($errors->all() as $error)
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      {{ $error }}
      <br/>
      @endforeach
    </div>
    @endif
  </div>

  <div class="form-group" id="images">
    <div class="col-sm-offset-2 row col-sm-8">
      @foreach($product->images as $image)
        <div class="col-xs-4 col-sm-3">
          <a class="thumbnail">{{ HTML::image(asset($image->thumb)) }}</a>
        </div>
      @endforeach
    </div>
  </div>

  <div class="form-group">
    {{ Form::label('images', 'Add Images', array('class'=>'col-sm-2 control-label')) }}
    <div class="col-sm-8">
      {{ Form::file('images[]', array('multiple'=>true)) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('price', 'Price', array('class'=>'col-sm-2 control-label')) }}
    <div class="col-sm-8">
      {{ Form::text('price', null, array('class'=>'form-control')) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('original_price', 'Original Price', array('class'=>'col-sm-2 control-label')) }}
    <div class="col-sm-8">
      {{ Form::text('original_price', null, array('class'=>'form-control')) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('quantity', 'Quantity', array('class'=>'col-sm-2 control-label')) }}
    <div class="col-sm-8">
      {{ Form::text('quantity', null, array('class'=>'form-control')) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('type', 'Type', array('class'=>'col-sm-2 control-label')) }}
    <div class="col-sm-8">
      {{ Form::select('type', array('tire' => 'Tire', 'rim' => 'Rim'), $type, array('class'=>'form-control')) }}
    </div>
  </div>

  <div class="tire container-fluid">
    <h3>Tire</h3>
    <div class="form-group">
      {{ Form::label('tire_size', 'Size', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('tire_size', $tire_data['tire_size'], array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('tire_brand_name', 'Brand Name', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('tire_brand_name', $tire_data['tire_brand_name'], array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('tire_description', 'Description', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::textarea('tire_description', $tire_data['tire_description'], array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('tire_model', 'Model', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('tire_model', $tire_data['tire_model'], array('class'=>'form-control')) }}
      </div>
    </div>
  </div>
  <div class="rim container-fluid">
    <h3>Rim</h3>
    <div class="form-group">
      {{ Form::label('rim_material', 'Material', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('rim_material', $rim_data['rim_material'], array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('rim_bolt_pattern', 'Bolt Pattern', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('rim_bolt_pattern', $rim_data['rim_bolt_pattern'], array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('rim_size', 'Size', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('rim_size', $rim_data['rim_size'], array('class'=>'form-control')) }}
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      {{ Form::submit('Edit Product', array('class'=>'form-control')) }}
    </div>
  </div>
{{ Form::close() }}

{{ Form::open(array('url' => 'products/' . $product['id'], 'role' => 'form', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-4">
      {{ Form::hidden('_method', 'DELETE') }}
      {{ Form::submit('Delete Product', array('class'=>'form-control', 'class'=>'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}

@stop
