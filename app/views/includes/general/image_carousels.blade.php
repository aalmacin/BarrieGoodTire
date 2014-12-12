@if(count($images) > 0)
  <div class="row col-sm-4 col-sm-offset-2">
    <div id="productCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
      <!-- Carousel items -->
      <div class="carousel-inner">
          @foreach($images as $i => $image)
          <div class="
          @if($i == 0)
          active
          @endif
          item">
          {{ HTML::image(asset($image->path)) }}
        </div>
        @endforeach
      </div>
      <!-- Carousel nav -->
      <a class="carousel-control left" href="#productCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="carousel-control right" href="#productCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
  </div>
@else
  <div class="row col-sm-4 col-sm-offset-2">
    <p>No Images</p>
  </div>
@endif
