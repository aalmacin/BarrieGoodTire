<div class="col-sm-2 col-lg-2 col-md-2">
  <div class="thumbnail">
    @if(count($tire['images']) > 0)
      <a href="details/{{ $tire['id'] }}">{{ HTML::image(asset($tire['images'][0]['thumb'])) }}</a>
    @endif
    <div class="caption">
      <h4>${{ $tire['price'] }} or best offer</h4>
      <h4>{{ link_to('details/'.$tire['id'], $tire['brand_name']) }}</h4>
      <p>{{ $tire['description'] }}</p>
      <p>Type: Tire</p>
    </div>
  </div>
</div>
