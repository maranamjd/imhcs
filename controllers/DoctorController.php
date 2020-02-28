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
   require 'models/Medication.php';
   require 'models/Lab_Request.php';
   require 'models/Lab_Test.php';

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
      $this->medication = new Medication();
      $this->lab_request = new Lab_Request();
      $this->lab_test = new Lab_Test();
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

    public function medication(){
      $this->view->js = ['doctor/js/medication.js'];
      $this->view->css = ['doctor/css/default.css'];

      $medications = $this->medication->join('patient', 'patient_id', "1");
      foreach ($medications as $key => $medication) {
        $id = $medication['med_id'];
        $medications[$key]['medicine'] = $this->medicine->select(["name"], "active = 1 AND med_id = $id")[0]['name'];
      }
      $this->view->data = $medications;
      $this->view->medicines = $this->medicine->select(['*'], "active = 1");

      $this->view->render('doctor/medication', 'doctor/inc');
    }

    public function laboratory(){
      $this->view->js = ['doctor/js/laboratory.js'];
      $this->view->css = ['doctor/css/default.css'];

      $requests = $this->lab_request->join('patient', 'patient_id', "1");
      foreach ($requests as $key => $request) {
        $id = $request['lab_id'];
        $requests[$key]['laboratory'] = $this->lab_test->select(["description"], "active = 1 AND lab_id = $id")[0]['description'];
      }
      $this->view->data = $requests;
      $this->view->lab_tests = $this->lab_test->select(['*'], "active = 1");

      $this->view->render('doctor/laboratory', 'doctor/inc');
    }

    public function vaccine(){
      $this->view->js = ['doctor/js/vaccine.js'];
      $this->view->css = ['doctor/css/default.css'];

      // $this->view->data = $this->patient->select(['*'], 'active = 1');

      $this->view->render('doctor/vaccine', 'doctor/inc');
    }

    public function referral(){
      $this->view->js = ['doctor/js/referral.js'];
      $this->view->css = ['doctor/css/default.css'];

      // $this->view->data = $this->patient->select(['*'], 'active = 1');

      $this->view->render('doctor/referral', 'doctor/inc');
    }

    public function report(){
      $this->view->js = ['doctor/js/report.js'];
      $this->view->css = ['doctor/css/default.css'];

      // $this->view->data = $this->patient->select(['*'], 'active = 1');

      $this->view->render('doctor/report', 'doctor/inc');
    }

  }
