<div class="col-sm-3 col-lg-3 col-md-3">
  <div class="thumbnail">
    @if(count($rim['images']) > 0)
      <a href="/details/{{ $rim['id'] }}">{{ HTML::image(asset($rim['images'][0]['thumb'])) }}</a>
    @else
      <a href="/details/{{ $rim['id'] }}">{{ HTML::image(asset('design/images/imagenotfound.jpg')) }}</a>
    @endif
    <div class="caption">
      <h4>{{ link_to('details/'.$rim['id'], 'More Details') }}</h4>
      <p class="price"><strong>${{ $rim['price'] }}</strong> or best offer</p>
      <p>Material: {{ $rim['material'] }}</p>
      <p>Type: Rim</p>
    </div>
  </div>
</div>
