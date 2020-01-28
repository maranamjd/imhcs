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
   require 'models/Checkup.php';
   require 'models/Prescription.php';

  class DoctorController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->doctor();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->patient = new Patient();
      $this->medicine = new Medicine();
      $this->med_category = new Med_Category();
      $this->checkup = new Checkup();
      $this->prescription = new Prescription();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['doctor/js/default.js'];
      $this->view->css = ['doctor/css/default.css'];
      $this->view->data = [
        'doctor' => $this->user->count('user_type = 1 AND active = 1'),
        'nurse' => $this->user->count('user_type = 2 AND active = 1'),
        'laboratorist' => $this->user->count('user_type = 3 AND active = 1'),
        'pharmacist' => $this->user->count('user_type = 4 AND active = 1'),
        'patient' => $this->patient->count('active = 1'),
        'medicine' => $this->medicine->count('active = 1')
      ];

      //render page
      $this->view->render('doctor/index', 'doctor/inc');
    }

    public function patient(){
      $this->view->js = ['doctor/js/patient.js'];
      $this->view->css = ['doctor/css/default.css'];

      $this->view->data = $this->patient->select(['*'], 'active = 1');

      $this->view->render('doctor/patient', 'doctor/inc');
    }

    public function checkup($id){
      $this->view->js = ['doctor/js/checkup.js'];
      $this->view->css = ['doctor/css/default.css'];

      $this->view->patient = $this->patient->select(['*'], "patient_id = '$id'")[0];
      $result =  $this->checkup->select(['*'], "active = 1 AND patient_id = '$id' ORDER BY date DESC");
      foreach ($result as $key => $checkup) {
        $user_id = $checkup['user_id'];
        $checkup_id = $checkup['checkup_id'];
        $result[$key]['doctor'] = $this->user_details->select(['firstname', 'middlename', 'lastname'], "user_id = '$user_id'")[0];
        $result[$key]['prescription'] = $this->prescription->join('medicine', 'med_id', "prescription.active = 1 AND checkup_id = $checkup_id");
      }
      $this->view->checkup = $result;
      $this->view->medicines = $this->medicine->select(['*'], "active = 1");

      $this->view->render('doctor/checkup', 'doctor/inc');
    }

  }
