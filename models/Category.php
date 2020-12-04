<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Category extends Eloquent
  {
      protected $fillable = ['name','img'];

      public function products()
      {
      	return $this->hasMany(Product::class,'cat_id');
      }
  }