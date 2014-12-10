<?php
class ProductImage extends Eloquent {
  public function product() {
    return $this->hasOne('Product');
  }

  public static function rules() {
    return array(
      'file' => 'mimes:png,gif,jpeg,jpg|max:20000'
    );
  }
}
