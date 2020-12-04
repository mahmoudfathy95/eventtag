<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Notification extends Eloquent
  {
      protected $fillable = ['title','body','user_id','type','type_id'];
  }