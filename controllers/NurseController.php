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
   require 'models/Immunization_Record.php';
   require 'models/Vaccine.php';
   require 'models/Vaccination.php';

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
      $this->immunization_record = new Immunization_Record();
      $this->vaccine = new Vaccine();
      $this->vaccination = new Vaccination();
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
    public function vaccine(){
      $this->view->js = ['nurse/js/vaccine.js'];
      $this->view->css = ['nurse/css/default.css'];

      $this->view->data = $this->immunization_record->select(['*'], 'active = 1');
      $this->view->vaccines = $this->vaccine->select(['*'], 'active = 1');

      $this->view->render('nurse/vaccine', 'nurse/inc');
    }
    public function immunization($id){
      $this->view->js = ['nurse/js/immunization.js'];
      $this->view->css = ['nurse/css/default.css'];

      $this->view->patient = $this->exists($this->immunization_record->select(['*'], "immunization_record_id = '$id'"));
      $vaccination_level = $this->get_vaccination($this->view->patient['vaccination_level']);
      $level = $this->view->patient['vaccination_level'];
      $result = $this->vaccine->select(['*'], "vaccine_id IN ($vaccination_level) AND active = 1");
      foreach ($result as $key => $vaccine) {
        $vaccine_id = $vaccine['vaccine_id'];
        $result[$key]['vaccinations'] = $this->vaccination->join('user_details', 'user_id', "vaccination.vaccine_id = $vaccine_id AND vaccination.immunization_record_id = $id AND vaccination.vaccination_level = $level AND vaccination.active = 1");
      }
      $this->view->vaccines = $result;
      if ($level > 1) {
        $this->view->next_vaccine = $this->vaccination->select(['max(vaccination_level)', 'remarks'], "immunization_record_id = $id")[0];
      }

      $this->view->render('nurse/immunization', 'nurse/inc');
    }

    public function report(){
      $this->view->js = ['nurse/js/default.js'];
      $this->view->css = ['nurse/css/default.css'];

      $this->view->render('nurse/report', 'nurse/inc');
    }

  }
