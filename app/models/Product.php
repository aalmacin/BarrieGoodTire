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
        $new_tire['id'] = $product->id;
        $new_tire['price'] = $product->price;
        $new_tire['original_price'] = $product->original_price;
        $new_tire['images'] = array();
        foreach($product->images() as $image) {
          $new_tire['images'][] = array(
            'original' => $image->original,
            'image' => $image->path,
            'thumb' => $image->thumb,
          );
        }
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
        $new_rim['id'] = $product->id;
        $new_rim['price'] = $product->price;
        $new_rim['original_price'] = $product->original_price;
        $new_rim['images'] = array();
        foreach($product->images() as $image) {
          $new_rim['images'][] = array(
            'original' => $image->original,
            'image' => $image->path,
            'thumb' => $image->thumb,
          );
        }
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
      $new_rim = array('type' => 'rim');
      $new_rim['price'] = $product->price;
      $new_rim['original_price'] = $product->original_price;
      $new_rim['images'] = array();
      foreach($product->images() as $image) {
        $new_rim['images'][] = array(
          'original' => $image->original,
          'image' => $image->path,
          'thumb' => $image->thumb,
        );
      }
      $new_rim['quantity'] = $product->quantity;
      // Rim
      $new_rim['material'] = $rim->material;
      $new_rim['size'] = $rim->size;
      $new_rim['bolt_pattern'] = $rim->bolt_pattern;
      return $new_rim;
    } else {
      $new_tire = array('type' => 'tire');
      $new_tire['price'] = $product->price;
      $new_tire['original_price'] = $product->original_price;
      $new_tire['images'] = array();
      foreach($product->images() as $image) {
        $new_tire['images'][] = array(
          'original' => $image->original,
          'image' => $image->path,
          'thumb' => $image->thumb,
        );
      }
      $new_tire['quantity'] = $product->quantity;
      // Tire
      $new_tire['brand_name'] = $tire->brand_name;
      $new_tire['description'] = $tire->description;
      $new_tire['size'] = $tire->size;
      $new_tire['model'] = $tire->model;
      return $new_tire;
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
    if(count($images) > 0) {
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
      $thumb_width = $img->width() / 4;
      $thumb_height = $img->height() / 4;
      $img->resize($thumb_width, $thumb_height);
      break;
      case 'image':
      $width = $img->width() / 2;
      $height = $img->height() / 2;
      $img->resize($width, $height);
      break;
    }

    $destination = $destinationPath.$hash_name;
    // Save Image
    $img->save($destination);
    return $destination;
  }
}
