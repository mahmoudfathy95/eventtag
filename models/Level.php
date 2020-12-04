<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Level extends Eloquent
  {
      protected $fillable = ['level_id','user_id'];
  }