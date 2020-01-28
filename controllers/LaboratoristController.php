<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';

  class LaboratoristController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->laboratorist();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['laboratorist/js/default.js'];
      $this->view->css = ['laboratorist/css/default.css'];

      //render page
      $this->view->render('laboratorist/index');
    }

  }
