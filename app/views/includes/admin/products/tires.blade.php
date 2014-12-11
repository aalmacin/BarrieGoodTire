<h2>Tires</h2>
@if(count($tires) > 0)
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Brand Name</th>
        <th>Description</th>
        <th>Size</th>
        <th>Model</th>
        <th>Original Price</th>
        <th>Price</th>
        @if($admin)
          <th>Show</th>
          <th>Edit</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($tires as $tire)
      <tr>
        <td>{{ $tire['quantity'] }}</td>
        <td>{{ $tire['brand_name'] }}</td>
        <td>{{ $tire['description'] }}</td>
        <td>{{ $tire['size'] }}</td>
        <td>{{ $tire['model'] }}</td>
        <td>{{ $tire['original_price'] }}</td>
        <td><strong>{{ $tire['price'] }}</strong></td>
        @if($admin)
          <td>{{ link_to('products/'.$tire['id'], 'Show') }}</td>
          <td>{{ link_to('products/'.$tire['id'].'/edit/', 'Edit') }}</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="container">
  <p>No Tires exist in the database.</p>
</div>
@endif
