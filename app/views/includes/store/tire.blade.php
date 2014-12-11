<div class="col-sm-4 col-lg-4 col-md-4">
  <div class="thumbnail">
    @if(count($tire['images']) > 0)
      <a href="details/{{ $tire['id'] }}" target="_blank">{{ HTML::image(asset($tire['images'][0]['thumb'])) }}</a>
    @endif
    <div class="caption">
      <h4>${{ $tire['price'] }} or best offer</h4>
      <h4>{{ link_to('details/'.$tire['id'], $tire['brand_name'], array('target' => '_blank')) }}</h4>
      <p>{{ $tire['description'] }}</p>
    </div>
  </div>
</div>
