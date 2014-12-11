<?php

class HomeController extends BaseController {

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

	public function index()
	{
		return View::make('index');
	}

	public function store()
	{
		return $this->storeCategory('all');
	}

	public function storeCategory($category)
	{
		$all = Product::scopeAllProducts();
		if($category == 'all') {
			$products = $all;
			$allResults = true;
		} else {
			if(isset($all[$category]) && count($all[$category]) > 0) {
				$products = $all[$category];
				$allResults = false;
			} else {
				$products = $all;
				$allResults = true;
			}
		}
		return View::make('store', array(
			'products' => $products,
			'all_results' => $allResults,
		));
	}

}
