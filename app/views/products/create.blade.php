@extends('products.layout')
@section('title')
Create Product
@stop
@section('content')
  {{ HTML::ul($errors->all) }}

  {{ Form::open(array('url' => 'products', 'method' => 'POST', 'files' => true)) }}
    <div>
      {{ Form::label('price', 'Price') }}
      {{ Form::text('price') }}
    </div>
    <div>
      {{ Form::label('original_price', 'Original Price') }}
      {{ Form::text('original_price') }}
    </div>
    <div>
      {{ Form::label('quantity', 'Quantity') }}
      {{ Form::text('quantity') }}
    </div>
    <!-- <div>
      {{ Form::label('') }}
      {{ Form::text('') }}
    </div> -->
    <div>
      {{ Form::label('type', 'Type') }}
      {{ Form::select('type', array('tire' => 'Tire', 'rim' => 'Rim')) }}
    </div>

    <div class="tire">
      <h3>Tire</h3>
      <div>
        {{ Form::label('tire_size', 'Size') }}
        {{ Form::text('tire_size') }}
      </div>
      <div>
        {{ Form::label('tire_brand_name', 'Brand Name') }}
        {{ Form::text('tire_brand_name') }}
      </div>
      <div>
        {{ Form::label('tire_description', 'Description') }}
        {{ Form::textarea('tire_description') }}
      </div>
      <div>
        {{ Form::label('tire_model', 'Model') }}
        {{ Form::text('tire_model') }}
      </div>
    </div>
    <div class="rim">
      <h3>Rim</h3>
      <div>
        {{ Form::label('rim_material', 'Material') }}
        {{ Form::text('rim_material') }}
      </div>
      <div>
        {{ Form::label('rim_bolt_pattern', 'Bolt Pattern') }}
        {{ Form::text('rim_bolt_pattern') }}
      </div>
      <div>
        {{ Form::label('rim_size', 'Size') }}
        {{ Form::text('rim_size') }}
      </div>
    </div>
    <div>
      {{ Form::submit('Submit') }}
    </div>
  {{ Form::close() }}
@stop
