<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Reset extends Eloquent
  {
      protected $fillable = ['code','user_id'];
  }