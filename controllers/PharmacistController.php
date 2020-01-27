<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';

  class PharmacistController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      Auth::pharmacist();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['pharmacist/js/default.js'];
      $this->view->css = ['pharmacist/css/default.css'];

      //render page
      $this->view->render('pharmacist/index');
    }

  }
