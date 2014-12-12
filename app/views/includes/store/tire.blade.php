<div class="col-sm-3 col-lg-3 col-md-3">
  <div class="thumbnail">
    @if(count($tire['images']) > 0)
      <a href="/details/{{ $tire['id'] }}">{{ HTML::image(asset($tire['images'][0]['thumb'])) }}</a>
    @else
      <a href="/details/{{ $tire['id'] }}">{{ HTML::image(asset('design/images/imagenotfound.jpg')) }}</a>
    @endif
    <div class="caption">
      <h4>{{ link_to('details/'.$tire['id'], $tire['brand_name']) }}</h4>
      <p class="price"><strong>${{ $tire['price'] }}</strong> or best offer</p>
      <p>{{ $tire['description'] }}</p>
      <p>Type: Tire</p>
    </div>
  </div>
</div>
