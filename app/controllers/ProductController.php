<?php

class ProductController extends \BaseController {

	/**
	* Instantiate a new ProductController instance.
	*/
	public function __construct()
	{
		$this->beforeFilter('@checkReader');
	}

	public function checkReader() {
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
		return View::make('products.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Input::all();

		$rules = array(
			'price' => 'required',
			'original_price' => 'required',
			'quantity' => 'required',
		);

		$type = $all['type'];
		switch($type) {
			case 'rim':
				// Rim
				$rules['rim_material'] = 'required';
				$rules['rim_size'] = 'required';
				$rules['rim_bolt_pattern'] = 'required';
			break;
			case 'tire':
				// Tire
				$rules['tire_brand_name'] = 'required';
				$rules['tire_description'] = 'required';
				$rules['tire_size'] = 'required';
				$rules['tire_model'] = 'required';
			break;
		}

		$validator = Validator::make($all, $rules);

		if($validator->fails()) {
			return Redirect::to('products/create')
				->withErrors($validator);
		} else {
			$product = new Product;
			$product->price = $all['price'];
			$product->original_price = $all['original_price'];
			$product->quantity = $all['quantity'];
			$product->save();
			switch($type) {
				case 'rim':
				$rim = new Rim;
				$rim->material = $all['rim_material'];
				$rim->size = $all['rim_size'];
				$rim->bolt_pattern = $all['rim_bolt_pattern'];
				$rim->product_id = $product->id;
				$rim->save();
				break;
				case 'tire':
				$tire = new Tire;
				$tire->brand_name = $all['tire_brand_name'];
				$tire->description = $all['tire_description'];
				$tire->size = $all['tire_size'];
				$tire->model = $all['tire_model'];
				$tire->product_id = $product->id;
				$tire->save();
				break;
			}
		}
		Session::flash('message', 'Successfully created product!');
		return Redirect::to('products');
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

		return View::make('products.show', array(
			'product' => $product,
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}