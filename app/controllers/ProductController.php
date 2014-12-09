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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
