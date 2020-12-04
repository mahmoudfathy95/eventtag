<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class Client extends Eloquent
  {
      protected $fillable = ['name','email','phone','password'];
  }