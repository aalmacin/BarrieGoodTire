<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title') | Barrie Good Tire</title>
  </head>
  <body>
    <h1>Admin Pages</h1>
    <nav>
      <ul>
        <li>{{ link_to('admin', 'Admin') }}</li>
        @yield('additional_nav')
        <li>{{ link_to('logout', 'Logout') }}</li>
      </ul>
    </nav>
    @yield('content')
  </body>
</html>
