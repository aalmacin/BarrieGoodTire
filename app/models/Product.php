<?php
class Product extends Eloquent {
  public static function scopeAllTires() {
    $all = self::all();
    $all_tires = array();

    foreach($all as $product) {
      $tires = $product->tires()->getResults();
      foreach($tires as $tire) {
        $new_tire = array();
        // Product
        $new_tire['price'] = $product->price;
        $new_tire['original_price'] = $product->original_price;
        $new_tire['image'] = $product->image;
        $new_tire['quantity'] = $product->quantity;
        // Tire
        $new_tire['brand_name'] = $tire->brand_name;
        $new_tire['description'] = $tire->description;
        $new_tire['size'] = $tire->size;
        $new_tire['model'] = $tire->model;
        $all_tires[] = $new_tire;
      }
    }
    return $all_tires;
  }

  public static function scopeAllRims() {
    $all = self::all();
    $all_rims = array();

    foreach($all as $product) {
      $rims = $product->rims()->getResults();
      foreach($rims as $rim) {
        $new_rim = array();
        // Product
        $new_rim['price'] = $product->price;
        $new_rim['original_price'] = $product->original_price;
        $new_rim['image'] = $product->image;
        $new_rim['quantity'] = $product->quantity;
        // Rim
        $new_rim['material'] = $rim->material;
        $new_rim['size'] = $rim->size;
        $new_rim['bolt_pattern'] = $rim->bolt_pattern;
        $all_rims[] = $new_rim;
      }
    }
    return $all_rims;
  }

  public static function scopeAllProducts() {
    $tires = self::scopeAllTires();
    $rims = self::scopeAllRims();
    $all = array(
      'tires' => $tires,
      'rims' => $rims,
    );
    return $all;
  }

  public function tires() {
    return $this->hasMany('Tire');
  }

  public function rims() {
    return $this->hasMany('Rim');
  }
}
