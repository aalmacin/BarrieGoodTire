<div class="form-group" id="images">
  <div class="col-sm-offset-2 row col-sm-8">
    @foreach($images as $image)
      <div class="col-xs-4 col-sm-3">
        <a class="thumbnail">{{ HTML::image(asset($image->thumb)) }}</a>
      </div>
    @endforeach
  </div>
</div>
