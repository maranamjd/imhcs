<?php
  /**
   *
   */
   //require templates
   require 'libs/reports/Patient.php';
   require 'libs/reports/Immunization.php';
   require 'libs/reports/Laboratory.php';
   require 'libs/reports/Medication.php';
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Patient.php';
   require 'models/Medicine.php';
   require 'models/Medication.php';
   require 'models/Med_Category.php';
   require 'models/Checkup.php';
   require 'models/Prescription.php';
   require 'models/Immunization_Record.php';
   require 'models/Vaccination.php';
   require 'models/Vaccine.php';
   require 'models/Referral.php';
   require 'models/Lab_Request.php';
   require 'models/Lab_Test.php';

  class ReportController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->patient = new Patient();
      $this->medicine = new Medicine();
      $this->med_category = new Med_Category();
      $this->checkup = new Checkup();
      $this->prescription = new Prescription();
      $this->immunization_record = new Immunization_Record();
      $this->vaccination = new Vaccination();
      $this->vaccine = new Vaccine();
      $this->referral = new Referral();
      $this->lab_request = new Lab_Request();
      $this->lab_test = new Lab_Test();
      $this->medication = new Medication();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
      $this->personnel = $this->user_details->select(['firstname', 'middlename', 'lastname'], "user_id = '$this->user_id'")[0];
    }

    public function patient(){
      $file = new PatientReportFile();
      $file->personnel = $this->name_format($this->personnel['firstname'],$this->personnel['lastname'],$this->personnel['middlename'],true);
      $file->data = $this->patient->select(['*'], "active = 1");
      $file->generate();
    }
    public function immunization(){
      $file = new ImmunizationReportFile();
      $file->personnel = $this->name_format($this->personnel['firstname'],$this->personnel['lastname'],$this->personnel['middlename'],true);
      $file->data = $this->immunization_record->select(['*'], "active = 1");
      $file->generate();
    }
    public function laboratory(){
      $file = new LaboratoryReportFile();
      $file->personnel = $this->name_format($this->personnel['firstname'],$this->personnel['lastname'],$this->personnel['middlename'],true);
      $tests = $this->lab_request->join('laboratory_test', 'lab_id', "1");
      foreach ($tests as $key => $test) {
        $user = $this->user_details->select(['firstname','middlename', 'lastname'], "user_id = '".$test['user_id']."'")[0];
        $patient = $this->patient->select(['firstname','middlename', 'lastname'], "patient_id = '".$test['patient_id']."'")[0];
        $tests[$key]['requested_by'] = $this->name_format($user['firstname'], $user['lastname'], $user['middlename'], true);
        $tests[$key]['patient'] = $this->name_format($patient['firstname'], $patient['lastname'], $patient['middlename'], true);
      }
      $file->data = $tests;
      $file->generate();
    }
    public function medication(){
      $file = new MedicationReportFile();
      $file->personnel = $this->name_format($this->personnel['firstname'],$this->personnel['lastname'],$this->personnel['middlename'],true);
      $medications = $this->medication->join('medicine', 'med_id', "1");
      foreach ($medications as $key => $medication) {
        $user = $this->user_details->select(['firstname','middlename', 'lastname'], "user_id = '".$medication['user_id']."'")[0];
        $patient = $this->patient->select(['firstname','middlename', 'lastname'], "patient_id = '".$medication['patient_id']."'")[0];
        $medications[$key]['requested_by'] = $this->name_format($user['firstname'], $user['lastname'], $user['middlename'], true);
        $medications[$key]['patient'] = $this->name_format($patient['firstname'], $patient['lastname'], $patient['middlename'], true);
        $medications[$key]['diagnosis'] = $this->checkup->select(['diagnosis'], "checkup_id = ".$medication['checkup_id'])[0]['diagnosis'];
      }
      $file->data = $medications;
      $file->generate();
    }



  }
