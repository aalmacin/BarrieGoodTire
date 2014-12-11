<?php

class ProductController extends \BaseController {


	/**
	* Instantiate a new ProductController instance.
	*/
	public function __construct()
	{
		$this->beforeFilter('@checkRole');
	}

	public function checkRole() {
		if(Auth::user()->role != 'accounting' && Auth::user()->role != 'admin') {
			App::abort(404);
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = Product::scopeAllProducts();
		return View::make('products.index', array(
			'tires' => $all['tires'],
			'rims' => $all['rims'],
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tire_data = Product::getTireData(null);
		$rim_data = Product::getRimData(null);
		return View::make('products.create', array(
			'product' => null,
			'tire_data' => $tire_data,
			'rim_data' => $rim_data,
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$fields = Input::all();
		return Product::validateFields(
			$fields,
			array(
				'product' => new Product,
				'rim' => new Rim,
				'tire' => new Tire
			),
			'products/create',
			'products'
		);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$product = Product::findProduct($id);
		$product_images = Product::find($id)->images()->getResults();

		return View::make('products.show', array(
			'product' => $product,
			'images' => $product_images,
		));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Product::find($id);


		if($product == null) App::abort('404');
		$tire = $product->tires()->first();
		$rim = $product->rims()->first();


		$tire_data = Product::getTireData($tire);
		$rim_data = Product::getRimData($rim);

		$type = '';

		if(count($tire) > 0) {
			$type = 'tire';
		} else if(count($rim) > 0) {
			$type = 'rim';
		}

		return View::make('products.edit', array(
			'tire_data' => $tire_data,
			'rim_data' => $rim_data,
			'type' => $type,
		))
			->with('product', $product);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$fields = Input::all();
		$product = Product::find($id);
		return Product::validateFields(
			$fields,
			array(
				'product' => $product,
				'rim' => $product->rims()->first(),
				'tire' => $product->tires()->first()
			),
			'products/'.$id.'/edit',
			'products/'.$id
		);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$product = Product::find($id);
		$tires = $product->tires();
		$rims = $product->rims();
		$images = $product->images();

		foreach($tires as $tire) {
			$tire->delete();
		}
		foreach($rims as $rim) {
			$rim->delete();
		}
		foreach($images as $image) {
			$image->delete();
		}

		$product->delete();
		Session::flash('message', 'Successfully deleted!');
		return Redirect::to('products');
	}


}
