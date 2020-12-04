<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class GroupPer extends Eloquent
{
  protected $table = 'group_per';
  protected $fillable = ['group_id','permission_id'];
}


 ?>
