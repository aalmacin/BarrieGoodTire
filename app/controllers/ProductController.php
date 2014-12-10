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

		$images = $all['images'];
		foreach($images as $file) {
			$rules = array(
				'file' => 'mimes:png,gif,jpeg,jpg|max:20000'
			);
			$imagevalidator = Validator::make(array('file'=> $file), $rules);

			if($imagevalidator->fails()){
				return Redirect::to('products/create')
				->withErrors($imagevalidator);
			}
		}

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

			foreach($images as $file) {
				$destinationPath = 'uploads';
				$ext      = $file->guessClientExtension();
				$fullname = $file->getClientOriginalName();
				$hashname = date('d.m.Y.H.i.s').'-'.md5($fullname).'.'.$ext;
				$upload_success = $file->move($destinationPath, $hashname);
			}
			Session::flash('message', 'Successfully created product!');
			return Redirect::to('products');
		}
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
		$product = Product::find($id);
		$rim_data = array();
		$tire_data = array();

		$tire_data['tire_brand_name'] = '';
		$tire_data['tire_size'] = '';
		$tire_data['tire_description'] = '';
		$tire_data['tire_model'] = '';
		$rim_data['rim_material'] = '';
		$rim_data['rim_size'] = '';
		$rim_data['rim_bolt_pattern'] = '';

		if($product == null) App::abort('404');
		$tire = $product->tires()->first();
		$rim = $product->rims()->first();

		if(count($tire) > 0) {
			$tire_data['tire_brand_name'] = $tire->brand_name;
			$tire_data['tire_size'] = $tire->size;
			$tire_data['tire_description'] = $tire->description;
			$tire_data['tire_model'] = $tire->model;
		} else if(count($rim) > 0) {
			$rim_data['rim_material'] = $rim->material;
			$rim_data['rim_size'] = $rim->size;
			$rim_data['rim_bolt_pattern'] = $rim->bolt_pattern;
		}

		return View::make('products.edit', array(
			'tire_data' => $tire_data,
			'rim_data' => $rim_data,
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
			return Redirect::to('products/'.$id.'/edit')
			->withErrors($validator);
		} else {
			$product = Product::find($id);;
			$product->price = $all['price'];
			$product->original_price = $all['original_price'];
			$product->quantity = $all['quantity'];
			$product->save();
			switch($type) {
				case 'rim':
				$rim = $product->rims()->first();
				$rim->material = $all['rim_material'];
				$rim->size = $all['rim_size'];
				$rim->bolt_pattern = $all['rim_bolt_pattern'];
				$rim->product_id = $product->id;
				$rim->save();
				break;
				case 'tire':
				$tire = $product->tires()->first();;
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
		foreach($tires as $tire) {
			$tire->delete();
		}
		foreach($rims as $rim) {
			$rim->delete();
		}
		$product->delete();
		Session::flash('message', 'Successfully deleted!');
		return Redirect::to('products');
	}


}
