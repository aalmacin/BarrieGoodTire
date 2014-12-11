@if($type == 'Edit')
  {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT', 'files' => true, 'role' => 'form', 'class' => 'form-horizontal')) }}
@else
  {{ Form::open(array('url' => 'products', 'method' => 'POST', 'files' => true, 'role' => 'form', 'class' => 'form-horizontal')) }}
@endif

  @include('includes.general.errors', array('errors' => $errors))

  @if($type == 'Edit')
    @include('includes.admin.products.image_thumbnails', array('images' => $product->images))
  @endif

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
      {{ Form::submit("$type Product", array('class'=>'form-control')) }}
    </div>
  </div>
{{ Form::close() }}
