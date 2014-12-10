<?php
class ProductImage extends Eloquent {
  public function product() {
    return $this->hasOne('Product');
  }
}
