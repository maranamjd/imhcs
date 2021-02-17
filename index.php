<?php

  require 'config.php';
  date_default_timezone_set("Asia/Manila");
  spl_autoload_register(function($class){
    require 'libs/'.$class.'.php';
  });

  $app = new Bootstrap();
