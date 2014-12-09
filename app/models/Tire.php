<?php
class Tire extends Eloquent {
  public function product() {
    return $this->hasOne('Product');
  }
  public function rim() {
    return $this->hasOne('Rim');
  }
}
