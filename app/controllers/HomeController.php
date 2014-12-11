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
		return View::make('index', array(
			'products' => Product::scopeAllProducts(),
			'category' => 'all',
		));
	}

	public function details($id)
	{
		$product = Product::findProduct($id);
		$product_images = Product::find($id)->images()->getResults();

		return View::make('details', array(
			'product' => $product,
			'images' => $product_images,
		));
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
		} else {
			if(isset($all[$category]) && count($all[$category]) > 0) {
				$products = array($category => $all[$category]);
			} else {
				$products = $all;
				$category = 'all';
			}
		}
		return View::make('store', array(
			'products' => $products,
			'category' => $category,
		));
	}

}
