<?php

  class helper
  {
  	 
  	 public static function hash($pass)
  	 {
  	 	return password_hash($pass, PASSWORD_BCRYPT,['cost'=>10]);
  	 }

  	 public static function checkHash($pass,$hash)
  	 {
  	 	return password_verify($pass, $hash);
  	 }

  	 public static function _token()
  	 {
  	 	return base64_encode(openssl_random_pseudo_bytes(32));
  	 }

     
  }
?>