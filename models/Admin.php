<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class Admin extends Eloquent
{
    protected $fillable = ['username','email','password','img','group_id','active'];


    public function group()
    {
      return $this->belongsTo(Group::class,'group_id');
    }
}


 ?>
