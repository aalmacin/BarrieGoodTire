@extends('products.layout')
@section('title')
Edit Product
@stop
@section('content')

{{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'files' => true)) }}
  <ul>
    @if ($errors->has())

    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach

    @endif
  </ul>
  <div id="images">
    <ul>
      @foreach($product->images as $image)
        <li>{{ HTML::image(asset($image->thumb)) }}</li>
      @endforeach
    </ul>
  </div>
  <div>
    {{ Form::file('images[]', array('multiple'=>true)) }}
  </div>
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
      {{ Form::text('tire_size', $tire_data['tire_size']) }}
    </div>
    <div>
      {{ Form::label('tire_brand_name', 'Brand Name') }}
      {{ Form::text('tire_brand_name', $tire_data['tire_brand_name']) }}
    </div>
    <div>
      {{ Form::label('tire_description', 'Description') }}
      {{ Form::textarea('tire_description', $tire_data['tire_description']) }}
    </div>
    <div>
      {{ Form::label('tire_model', 'Model') }}
      {{ Form::text('tire_model', $tire_data['tire_model']) }}
    </div>
  </div>
  <div class="rim">
    <h3>Rim</h3>
    <div>
      {{ Form::label('rim_material', 'Material') }}
      {{ Form::text('rim_material', $rim_data['rim_material']) }}
    </div>
    <div>
      {{ Form::label('rim_bolt_pattern', 'Bolt Pattern') }}
      {{ Form::text('rim_bolt_pattern', $rim_data['rim_bolt_pattern']) }}
    </div>
    <div>
      {{ Form::label('rim_size', 'Size') }}
      {{ Form::text('rim_size', $rim_data['rim_size']) }}
    </div>
  </div>
  <div>
    {{ Form::submit('Submit') }}
  </div>
{{ Form::close() }}



{{ Form::open(array('url' => 'products/' . $product['id'])) }}
{{ Form::hidden('_method', 'DELETE') }}
<td>{{ Form::submit('Delete') }}</td>
{{ Form::close() }}
<p>{{ link_to('products/', 'Back to Products') }}</p>
@stop
