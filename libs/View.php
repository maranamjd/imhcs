<?php

  /**
   *
   */
  class View
  {

    function __construct()
    {
      // echo 'this is the view<br>';
    }

    public function render($name, $nav = '', $template = true){
      if ($template) {
        if ($nav != '') {
          require 'views/template/header.php';
          require 'views/'.$nav.'/nav.php';
          require 'views/'. $name .'.php';
          require 'views/template/footer.php';
        }else {
          require 'views/template/header.php';
          require 'views/'. $name .'.php';
          require 'views/template/footer.php';
        }
      }else {
        require 'views/'. $name .'.php';
      }
    }
  }
