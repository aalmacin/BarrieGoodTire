<?php
class Product extends Eloquent {

  public static function scopeAllTires() {
    $all = self::all();
    $all_tires = array();

    foreach($all as $product) {
      $tires = $product->tires()->getResults();
      foreach($tires as $tire) {
        $all_tires[] = self::getTempTire($product, $tire);
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
        $all_rims[] = self::getTempRim($product, $rim);
      }
    }
    return $all_rims;
  }

  public static function scopeAllProducts() {
    $tires = self::scopeAllTires();
    $rims = self::scopeAllRims();

    return array(
      'tires' => $tires,
      'rims' => $rims,
    );
  }

  public static function findProduct($id) {
    $product = Product::find($id);
    if($product == null) {
      App::abort(404);
    }
    $tire = $product->tires()->first();
    $rim = $product->rims()->first();
    if($rim != null) {
      $temp_rim = self::getTempRim($product, $rim);
      $temp_rim['type'] = 'rim';
      return $temp_rim;
    } else {
      $temp_tire = self::getTempTire($product, $tire);
      $temp_tire['type'] = 'tire';
      return $temp_tire;
    }
  }

  public function tires() {
    return $this->hasMany('Tire');
  }

  public function rims() {
    return $this->hasMany('Rim');
  }

  public function images() {
    return $this->hasMany('ProductImage');
  }

  /**
  * Getting the rim and tire data
  */
  public static function getTireData($tire) {
    $tire_data = array();

    $tire_data['tire_brand_name'] = '';
    $tire_data['tire_size'] = '';
    $tire_data['tire_description'] = '';
    $tire_data['tire_model'] = '';


    if(count($tire) > 0) {
      $tire_data['tire_brand_name'] = $tire->brand_name;
      $tire_data['tire_size'] = $tire->size;
      $tire_data['tire_description'] = $tire->description;
      $tire_data['tire_model'] = $tire->model;
    }

    return $tire_data;
  }

  public static function getRimData($rim) {
    $rim_data = array();
    $rim_data['rim_material'] = '';
    $rim_data['rim_size'] = '';
    $rim_data['rim_bolt_pattern'] = '';

    if(count($rim) > 0) {
      $rim_data['rim_material'] = $rim->material;
      $rim_data['rim_size'] = $rim->size;
      $rim_data['rim_bolt_pattern'] = $rim->bolt_pattern;
    }

    return $rim_data;
  }

  /**
  * Default rules for all validations
  */
  public static function getAllRules($type) {
    $rules = self::getProductRules();

    switch($type) {
      case 'rim':
      $rules = self::setRimRules($rules);
      break;
      case 'tire':
      $rules = self::setTireRules($rules);
      break;
    }
    return $rules;
  }

  /**
  * Default rules for product validation
  */
  private static function getProductRules() {
    return array(
      'price' => 'required',
      'original_price' => 'required',
      'quantity' => 'required',
    );
  }

  /**
  * Default rules for rim validation
  */
  private static function setRimRules($rules) {
    $rules['rim_material'] = 'required';
    $rules['rim_size'] = 'required';
    $rules['rim_bolt_pattern'] = 'required';
    return $rules;
  }

  /**
  * Default rules for tire validation
  */
  private static function setTireRules($rules) {
    $rules['tire_brand_name'] = 'required';
    $rules['tire_description'] = 'required';
    $rules['tire_size'] = 'required';
    $rules['tire_model'] = 'required';
    return $rules;
  }

  public static function validateFields($fields, $objects, $formpage, $donepage) {
    $type = $fields['type'];
    $rules = Product::getAllRules($type);

    // Validate images
    $images = $fields['images'];
    if(count($images) > 0) {
      $validator = self::validateImages($images);
      if($validator != null) {
        return Redirect::to($formpage)
        ->withErrors($validator);
      }
    }

    // Validate fields
    $validator = Validator::make($fields, $rules);
    if($validator->fails()) {
      return Redirect::to($formpage)
      ->withErrors($validator);
    } else {
      self::saveToDB($fields, $objects['product'], $objects['rim'], $objects['tire']);
      Session::flash('message', 'Successfully saved product!');
      return Redirect::to($donepage);
    }
  }

  /**
  * Validate images
  */
  private static function validateImages($images) {
    $validator = null;
    foreach($images as $file) {
      $rules = ProductImage::rules();
      $imagevalidator = Validator::make(array('file'=> $file), $rules);

      if($imagevalidator->fails()){
        $validator = $imagevalidator;
      }
    }
    return $validator;
  }

  /**
  * Save to database
  */
  private static function saveToDB($fields, $product, $rim, $tire) {
    $product = self::saveProduct($product, $fields);
    switch($fields['type']) {
      case 'rim':
        self::saveRim($rim, $product->id, $fields);
      break;
      case 'tire':
        self::saveTire($tire, $product->id, $fields);
      break;
    }

    $images = $fields['images'];
    if(count($images[0]) > 0) {
      self::saveImages($images, $product->id);
    }
  }

  /**
  * Save the product and return the product object
  */
  private static function saveProduct($product, $fields) {
    $product->price = $fields['price'];
    $product->original_price = $fields['original_price'];
    $product->quantity = $fields['quantity'];
    $product->save();
    return $product;
  }

  private static function saveRim($rim, $product_id, $fields) {
    $rim->material = $fields['rim_material'];
    $rim->size = $fields['rim_size'];
    $rim->bolt_pattern = $fields['rim_bolt_pattern'];
    $rim->product_id = $product_id;
    $rim->save();
  }

  private static function saveTire($tire, $product_id, $fields) {
    $tire->brand_name = $fields['tire_brand_name'];
    $tire->description = $fields['tire_description'];
    $tire->size = $fields['tire_size'];
    $tire->model = $fields['tire_model'];
    $tire->product_id = $product_id;
    $tire->save();
  }

  private static function saveImages($images, $product_id) {
    foreach($images as $file) {
      $img = Image::make($file->getRealPath());

      // Get hash name
      $ext      = $file->guessClientExtension();
      $fullname = $file->getClientOriginalName();
      $hash_name = date('d.m.Y.H.i.s').'-'.md5($fullname).'.'.$ext;

      // Save images
      $original = self::savePhysicalImage($img, $hash_name, 'original');
      $image = self::savePhysicalImage($img, $hash_name, 'image');
      $thumb = self::savePhysicalImage($img, $hash_name, 'thumb');

      // Create the product image record
      $product_image = new ProductImage;
      $product_image->product_id = $product_id;

      $product_image->orig = $original;
      $product_image->path = $image;
      $product_image->thumb = $thumb;
      $product_image->save();
    }
  }

  /**
  * Save the image
  */
  private static function savePhysicalImage($img, $hash_name, $type) {
    $destinationPath = "uploads/$type/$type.";

    switch($type) {
      case 'thumb':
      $thumb_width = 160;
      $thumb_height = 212;
      $img->resize($thumb_width, $thumb_height);
      break;
      case 'image':
      $width = 320;
      $height = 424;
      $img->resize($width, $height);
      break;
    }

    $destination = $destinationPath.$hash_name;
    $wholePath = base_path()."/public/$destination";
    // Save Image
    $img->save($wholePath);
    return $destination;
  }


  private static function getTempTire($product, $tire) {
    $temp_tire = self::getTempProduct($product);
    // Tire
    $temp_tire['brand_name'] = $tire->brand_name;
    $temp_tire['description'] = $tire->description;
    $temp_tire['size'] = $tire->size;
    $temp_tire['model'] = $tire->model;
    return $temp_tire;
  }

  private static function getTempRim($product, $rim) {
    $temp_rim = self::getTempProduct($product);
    // Rim
    $temp_rim['material'] = $rim->material;
    $temp_rim['size'] = $rim->size;
    $temp_rim['bolt_pattern'] = $rim->bolt_pattern;
    return $temp_rim;
  }

  private static function getTempProduct($product) {
    $temp = array();
    $temp['id'] = $product->id;
    $temp['price'] = $product->price;
    $temp['original_price'] = $product->original_price;
    $temp['images'] = array();
    foreach($product->images()->getResults() as $image) {
      $temp['images'][] = array(
        'original' => $image->original,
        'image' => $image->path,
        'thumb' => $image->thumb,
      );
    }
    $temp['quantity'] = $product->quantity;
    return $temp;
  }
}
