<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>@yield('title') | Barrie Good Tire</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/vertical-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body id="storebody">
    <div class="container-fluid">
      <div class="page-header">
        <h1>Barrie Good Tire</h1>
      </div>
      <div class="well row">
        <p>To place an order, email <a href="mailto:julien@barriegoodtire.com">julien@barriegoodtire.com</a> or call <a href="tel:17057171034">705-717-1034</a></p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="sidebar-nav">
            <div class="navbar navbar-default" role="navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <span class="visible-xs navbar-brand">Sidebar menu</span>
              </div>
              <div class="mainnav navbar-collapse collapse sidebar-navbar-collapse">
                <ul class="nav navbar-nav">
                  <li>{{ link_to('/', 'Home') }}</li>
                  <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Store <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>{{ link_to('store', 'All') }}</li>
                      <li class="divider"></li>
                      <li>{{ link_to('store/tires', 'Tires') }}</li>
                      <li>{{ link_to('store/rims', 'Rims') }}</li>
                    </ul>
                  </li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          @yield('content')
        </div>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
