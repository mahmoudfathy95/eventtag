<?php
  require_once 'vendor/autoload.php';
  require_once 'lib/Database.php';
  

  echo User::find(1)->name;
