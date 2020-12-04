<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Event extends Eloquent
  {
      protected $fillable = ['id','eventName','hallName','city','day_from','day_to','time_from','time_to','lat','lang','cover','permission','map','user_id'];

      public function booths()
      {
      	return $this->hasMany(Booth::class);
      }

      public function order()
      {
        return $this->hasOne(Order::class)->with('user');
      }

      public function user()
      {
      	return $this->belongsTo(User::class);
      }
  }