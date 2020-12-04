<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Walk extends Eloquent
  {
      protected $fillable = ['title','details','img'];
  }