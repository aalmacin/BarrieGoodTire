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
    @yield('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
