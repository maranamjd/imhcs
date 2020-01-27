<?php

  /**
   *
   */
  class Hash
  {

    function __construct()
    {
      // echo 'this is the view<br>';
    }

    public function encrypt($txt){
      $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      $encrypted = openssl_encrypt($txt, 'aes-256-cbc', $encryption_key, 0,
      $iv);
      return base64_encode($encrypted . '::' . $iv);
    }
    public function decrypt($hash){
      $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
      list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($hash),
      2),2,null);
      return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0,
      $iv);
    }
  }
