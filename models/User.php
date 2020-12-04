<?php

  use Illuminate\Database\Eloquent\Model as Eloquent;
  class User extends Eloquent
  {
      protected $fillable = ['name','email','phone','password','type','brand','front','back','cr','token','active','code','company','logo','expedition','lat','lang','firebase','keyCountry'];
  }