<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Medication.php';
   require 'models/Medicine.php';

  class PharmacistController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->pharmacist();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->medication = new Medication();
      $this->medicine = new Medicine();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['pharmacist/js/default.js'];
      $this->view->css = ['pharmacist/css/default.css'];

      //render page
      $this->view->render('pharmacist/index', 'pharmacist/inc');
    }
    public function medication(){
      $this->view->js = ['pharmacist/js/medication.js'];
      $this->view->css = ['pharmacist/css/default.css'];

      $medications = $this->medication->join('patient', 'patient_id', "1");
      foreach ($medications as $key => $medication) {
        $id = $medication['med_id'];
        $medications[$key]['medicine'] = $this->medicine->select(["name"], "active = 1 AND med_id = $id")[0]['name'];
      }
      $this->view->data = $medications;
      $this->view->medicines = $this->medicine->select(['*'], "active = 1");

      $this->view->render('pharmacist/medication', 'pharmacist/inc');
    }

  }
