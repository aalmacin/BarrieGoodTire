@if($category == 'tires')
  @include('includes.store.tires', array('products' => $products))
@elseif($category == 'rims')
  @include('includes.store.rims', array('products' => $products))
@else
  @include('includes.store.tires', array('products' => $products))
  @include('includes.store.rims', array('products' => $products))
@endif
