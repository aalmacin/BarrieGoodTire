<div class="col-md-12">
  <h2>All Products</h2>
  <div class="row">
    @each('includes.store.tire', $products['tires'], 'tire')
    @each('includes.store.rim', $products['rims'], 'rim')
  </div>
</div>
