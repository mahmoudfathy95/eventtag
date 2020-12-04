<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Orderbooth extends Eloquent
  {
      protected $fillable = ['id','booths_id','event_id'];
  }