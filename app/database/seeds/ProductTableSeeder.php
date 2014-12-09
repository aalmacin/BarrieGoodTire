<?php

class ProductTableSeeder extends Seeder
{

  public function run()
  {
    DB::table('tires')->delete();
    DB::table('rims')->delete();
    DB::table('products')->delete();

    Product::create(array(
      'price'     => 100.00,
      'original_price' => 50.00,
      'image' => URL::asset('images/bfgoodrich1.jpg'),
      'quantity' => 4,
    ));

    Product::create(array(
      'price'     => 200.00,
      'original_price' => 100.00,
      'image' => URL::asset('images/bfgoodrich.jpg'),
      'quantity' => 4,
    ));

    Rim::create(array(
      'material'     => 'steel',
      'size' => '15',
      'bolt_pattern' => '3',
      'product_id' => 1,
    ));

    Tire::create(array(
      'brand_name'     => 'Goodrich',
      'description' => 'Very good tire',
      'size' => '15',
      'model' => '2006',
      'product_id' => 2,
      'rim_id' => 1,
    ));
  }

}
