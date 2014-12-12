<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>@yield('title') | Barrie Good Tire</title>
    @include('includes.general.header')

    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div id="adminbody">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <ul class="nav nav-pills">
          <li role="presentation">{{ link_to('admin', 'Admin') }}</li>
          @yield('additional_nav')
          <li role="presentation">{{ link_to('logout', 'Logout') }}</li>
        </ul>
      </nav>
      <div class="container-fluid">
        <div class="page-header">
          <h1>Admin</h1>
        </div>
        {{ Session::get('error') }}
        {{ Session::get('message') }}
        @yield('content')
      </div>
    </div>
    @include('includes.general.footer')
  </body>
</html>
