<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Request extends Eloquent
  {
      protected $fillable = ['id','booths_id','order_id'];

     public function booths()
     {
     	return $this->belongsTo(Booth::class);
     }

  }