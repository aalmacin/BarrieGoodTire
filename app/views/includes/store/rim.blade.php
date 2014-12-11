<div class="col-sm-2 col-lg-2 col-md-2">
  <div class="thumbnail">
    @if(count($rim['images']) > 0)
      <a href="details/{{ $rim['id'] }}" target="_blank">{{ HTML::image(asset($rim['images'][0]['thumb'])) }}</a>
    @else
    <a href="details/{{ $rim['id'] }}" target="_blank">{{ HTML::image('http://lorempixel.com/80/106/') }}</a>
    @endif
    <div class="caption">
      <h4>${{ $rim['price'] }} or best offer</h4>
      <h4>{{ link_to('details/'.$rim['id'], 'More Details', array('target' => '_blank')) }}</h4>
      <p>Material {{ $rim['material'] }}</p>
    </div>
  </div>
</div>
