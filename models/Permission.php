<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class Permission extends Eloquent
{
    protected $table = 'permissions';
    protected $fillable = ['name','type','action','sort','url'];

}


 ?>
