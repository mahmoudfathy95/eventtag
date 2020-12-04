<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Order extends Eloquent
  {
      protected $fillable = ['id','user_id','event_id'];

      public function event()
      {
      	return $this->belongsTo(Event::class);
      }

      public function user()
      {
        return $this->belongsTo(User::class);
      }

      public function request()
      {
      	return $this->hasMany(Request::class)->with('booths');
      }

       public function rproduct()
      {
        return $this->hasMany(Rproduct::class)->with('products');
      }

      
     
  }