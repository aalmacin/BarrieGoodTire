<?php
class Rim extends Eloquent {
  public function product() {
    return $this->hasOne('Product');
  }

  public function tires() {
    return $this->hasMany('Tire');
  }
}
