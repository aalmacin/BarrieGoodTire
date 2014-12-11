<h2>Rims</h2>
@if(count($rims) > 0)
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Material</th>
        <th>Size</th>
        <th>Bolt Pattern</th>
        <th>Original Price</th>
        <th>Price</th>
        @if($admin)
          <th>Show</th>
          <th>Edit</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($rims as $rim)
      <tr>
        <td>{{ $rim['quantity'] }}</td>
        <td>{{ $rim['material'] }}</td>
        <td>{{ $rim['size'] }}</td>
        <td>{{ $rim['bolt_pattern'] }}</td>
        <td>{{ $rim['original_price'] }}</td>
        <td><strong>{{ $rim['price'] }}</strong></td>
        @if($admin)
          <td>{{ link_to('products/'.$rim['id'], 'Show') }}</td>
          <td>{{ link_to('products/'.$rim['id'].'/edit/', 'Edit') }}</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="container">
  <p>No Rims exist in the database.</p>
</div>
@endif
