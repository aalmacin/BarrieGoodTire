<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title') | Barrie Good Tire</title>
  </head>
  <body>
    <h1>Products</h1>
    <nav>
      <ul>
        <li>{{ link_to('admin', 'Admin') }}</li>

        <li>{{ link_to('logout', 'Logout') }}</li>
      </ul>
    </nav>
    @yield('content')
  </body>
</html>
