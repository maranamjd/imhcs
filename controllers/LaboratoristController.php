<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Lab_Request.php';
   require 'models/Lab_Test.php';

  class LaboratoristController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->laboratorist();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->lab_request = new Lab_Request();
      $this->lab_test = new Lab_Test();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['laboratorist/js/default.js'];
      $this->view->css = ['laboratorist/css/default.css'];

      //render page
      $this->view->render('laboratorist/index', 'laboratorist/inc');
    }

    public function laboratory(){
      $this->view->js = ['laboratorist/js/laboratory.js'];
      $this->view->css = ['laboratorist/css/default.css'];

      $requests = $this->lab_request->join('patient', 'patient_id', "1");
      foreach ($requests as $key => $request) {
        $id = $request['lab_id'];
        $requests[$key]['laboratory'] = $this->lab_test->select(["description"], "active = 1 AND lab_id = $id")[0]['description'];
      }
      $this->view->data = $requests;
      $this->view->lab_tests = $this->lab_test->select(['*'], "active = 1");

      $this->view->render('laboratorist/laboratory', 'laboratorist/inc');
    }

  }
