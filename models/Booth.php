<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Booth extends Eloquent
  {
      protected $fillable = ['event_id','name','price'];

      public function event()
      {
      	return $this->belongsTo(Event::class);
      }
      public function sevent()
      {
      	return $this->belongsTo(Event::class)->with('order');
      }
      
     
      
      public function order()
      {
      	return $this->belongsToMany(Order::class,'requests','booths_id')->with('user');
      }

  }