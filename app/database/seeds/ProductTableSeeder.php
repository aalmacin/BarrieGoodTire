<?php

class ProductTableSeeder extends Seeder
{

  public function run()
  {
    DB::table('tires')->delete();
    DB::table('rims')->delete();
    DB::table('products')->delete();

    Product::create(array(
      'id' => 1,
      'price'     => 100.00,
      'original_price' => 50.00,
      'quantity' => 4,
    ));

    Rim::create(array(
      'material'     => 'steel',
      'size' => '15',
      'bolt_pattern' => '3',
      'product_id' => 1,
    ));

    Product::create(array(
      'id' => 2,
      'price'     => 200.00,
      'original_price' => 100.00,
      'quantity' => 4,
    ));

    Tire::create(array(
      'brand_name'     => 'Goodrich',
      'description' => 'Very good tire',
      'size' => '15',
      'model' => '2006',
      'product_id' => 2,
      'rim_id' => 1,
    ));

    Product::create(array(
      'id' => 3,
      'price'     => 150.00,
      'original_price' => 100.00,
      'quantity' => 7,
    ));

    Tire::create(array(
      'brand_name'     => 'Dynapro',
      'description' => 'Very good tire. 98% Thread',
      'size' => '16',
      'model' => '2009',
      'product_id' => 3,
      'rim_id' => null,
    ));

    Product::create(array(
      'id' => 4,
      'price'     => 200.00,
      'original_price' => 150.00,
      'quantity' => 3,
    ));

    Rim::create(array(
      'material'     => 'alloy',
      'size' => '19',
      'bolt_pattern' => '6',
      'product_id' => 4,
    ));
  }

}
