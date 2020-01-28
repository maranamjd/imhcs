<?php
  /**
   *
   */


  class HomeController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->scan();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['home/js/default.js'];
      $this->view->css = ['home/css/default.css'];

      //render page
      $this->view->render('home/index');
    }




  }
