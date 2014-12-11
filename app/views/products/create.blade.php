@extends('products.layout')
@section('title')
Create Product
@stop
@section('content')

  <div class="col-sm-offset-8 col-sm-12">
    <p>{{ link_to('products/', 'Back to Products') }}</p>
  </div>
  {{ Form::open(array('url' => 'products', 'method' => 'POST', 'files' => true, 'role' => 'form', 'class' => 'form-horizontal')) }}

    <div class="col-sm-12">
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
        {{ Form::select('type', array('tire' => 'Tire', 'rim' => 'Rim'), null, array('class'=>'form-control')) }}
      </div>
    </div>

    <div class="tire container-fluid">
      <h3>Tire</h3>
      <div class="form-group">
        {{ Form::label('tire_size', 'Size', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('tire_size', null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('tire_brand_name', 'Brand Name', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('tire_brand_name', null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('tire_description', 'Description', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::textarea('tire_description', null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('tire_model', 'Model', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('tire_model', null, array('class'=>'form-control')) }}
        </div>
      </div>
    </div>
    <div class="rim container-fluid">
      <h3>Rim</h3>
      <div class="form-group">
        {{ Form::label('rim_material', 'Material', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('rim_material', null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('rim_bolt_pattern', 'Bolt Pattern', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('rim_bolt_pattern', null, array('class'=>'form-control')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('rim_size', 'Size', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
          {{ Form::text('rim_size', null, array('class'=>'form-control')) }}
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-4">
        {{ Form::submit('Create Product', array('class'=>'form-control')) }}
      </div>
    </div>
  {{ Form::close() }}
@stop
