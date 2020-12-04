<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Rproduct extends Eloquent
  {
    protected $fillable = ['id','product_id','order_id'];

	 public function products()
	 {
	 	return $this->belongsTo(Product::class,'product_id');
	 }
  }