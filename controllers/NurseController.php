<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Patient.php';
   require 'models/Medicine.php';
   require 'models/Med_Category.php';

  class NurseController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->nurse();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->patient = new Patient();
      $this->medicine = new Medicine();
      $this->med_category = new Med_Category();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['nurse/js/default.js'];
      $this->view->css = ['nurse/css/default.css'];
      $this->view->data = [
        'doctor' => $this->user->count('user_type = 1 AND active = 1'),
        'nurse' => $this->user->count('user_type = 2 AND active = 1'),
        'laboratorist' => $this->user->count('user_type = 3 AND active = 1'),
        'pharmacist' => $this->user->count('user_type = 4 AND active = 1'),
        'patient' => $this->patient->count('active = 1'),
        'medicine' => $this->medicine->count('active = 1')
      ];

      //render page
      $this->view->render('nurse/index', 'nurse/inc');
    }

    public function patient(){
      $this->view->js = ['nurse/js/patient.js'];
      $this->view->css = ['nurse/css/default.css'];

      $this->view->data = $this->patient->select(['*'], 'active = 1');

      $this->view->render('nurse/patient', 'nurse/inc');
    }

    public function report(){
      $this->view->js = ['nurse/js/default.js'];
      $this->view->css = ['nurse/css/default.css'];

      $this->view->render('nurse/report', 'nurse/inc');
    }

  }
