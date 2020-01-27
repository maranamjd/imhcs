<?php
  /**
   *
   */
  class Excptn extends Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function show($type, $message){
      $this->view->type = $type;
      $this->view->message = $message;
      $this->view->css = ['excptn/css/default.css'];
      $this->view->js = ['excptn/js/default.js'];
      $this->view->render('excptn/index');
    }

  }
