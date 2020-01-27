<?php

  require 'config.php';
  date_default_timezone_set("Asia/Manila");
  function __autoload($class){
    require 'libs/'.$class.'.php';
  }

  $app = new Bootstrap();
