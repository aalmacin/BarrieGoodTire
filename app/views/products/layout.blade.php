<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>@yield('title') | Barrie Good Tire</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div id="adminbody">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <ul class="nav nav-tabs">
          <li role="presentation">{{ link_to('admin', 'Admin') }}</li>
          <li role="presentation">{{ link_to('products', 'Products') }}</li>
          <li role="presentation">{{ link_to('logout', 'Logout') }}</li>
        </ul>
      </nav>
      <div class="container-fluid">
        <div class="page-header">
          <h1>Products</h1>
        </div>
        {{ Session::get('error') }}
        {{ Session::get('message') }}
        @yield('content')
      </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
