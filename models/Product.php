<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Product extends Eloquent
  {
      protected $fillable = ['name','details','img','cat_id'];

      public function category()
      {
      	return $this->belongsTo(Category::class,'cat_id');
      }
  }
