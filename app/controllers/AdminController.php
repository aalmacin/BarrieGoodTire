<?php

class AdminController extends BaseController {

  /*
  |--------------------------------------------------------------------------
  | Default Home Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  |	Route::get('/', 'HomeController@showWelcome');
  |
  */

  public function showAdmin()
  {
    $all = Product::scopeAllProducts();
    return View::make('admin.index', array(
      'tires' => $all['tires'],
      'rims' => $all['rims'],
    ));
  }

  public function showLogin()
  {
    return View::make('admin.login');
  }

  public function doLogin()
  {
    $rules = array(
      'username'    => 'required',
      'password' => 'required|alphaNum|min:3'
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
      return Redirect::to('admin.login')
      ->withErrors($validator)
      ->withInput(Input::except('password'));
    } else {
      $userdata = array(
        'username' 	=> Input::get('username'),
        'password' 	=> Input::get('password')
      );

      if (Auth::attempt($userdata)) {
        return Redirect::to('admin.index');
      } else {
        return Redirect::to('admin.login');
      }
    }
  }


  public function doLogout()
  {
    Auth::logout();
    return Redirect::to('admin.login');
  }

}
