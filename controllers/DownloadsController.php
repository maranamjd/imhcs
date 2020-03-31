<?php
  /**
   *
   */
   //require templates
   require 'libs/downloads/Prescription.php';
   require 'libs/downloads/Immunization.php';
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Patient.php';
   require 'models/Medicine.php';
   require 'models/Med_Category.php';
   require 'models/Checkup.php';
   require 'models/Prescription.php';
   require 'models/Immunization_Record.php';
   require 'models/Vaccination.php';
   require 'models/Vaccine.php';

  class DownloadsController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->special();
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
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function prescription($id){
      $checkup = $this->exists($this->checkup->select(['patient_id', 'notes'], "checkup_id = $id"), true);
      $personnel = $this->user_details->select(['firstname', 'middlename', 'lastname'], "user_id = '$this->user_id'")[0];
      $prescription = $this->prescription->join('medicine', 'med_id', "prescription.active = 1 AND checkup_id = $id");
      $patient = $this->patient->select(['*'], "patient_id = '".$checkup[0]['patient_id']."'")[0];

      $this->file = new PrescriptionFile();
      $this->file->patient_name = $this->name_format($patient['firstname'],$patient['lastname'],$patient['middlename'],true);
      $this->file->address = $patient['address'];
      $this->file->age = $this->get_age($patient['birthdate']);
      $this->file->sex = $this->get_sex($patient['sex']);
      $this->file->personnel = $this->name_format($personnel['firstname'],$personnel['lastname'],$personnel['middlename'],true);
      $this->file->data = $prescription;
      $this->file->generate();
    }

    public function immunization($id){
      $immunization = $this->exists($this->immunization_record->select(['*'], "immunization_record_id = $id"));
      $personnel = $this->user_details->select(['firstname', 'middlename', 'lastname'], "user_id = '$this->user_id'")[0];
      $vaccination = [];
      for ($i=1; $i <= 6 ; $i++) {
        $vaccination[$i] = $this->vaccination->join('vaccine', 'vaccine_id', "vaccination.immunization_record_id = $id AND vaccination_level = $i");
      }
      $vaccines = $this->vaccine->all();

      $this->file = new ImmunizationFile();
      $this->file->child_name = $immunization['child_name'];
      $this->file->mother_name = $immunization['mother_name'];
      $this->file->father_name = $immunization['father_name'];
      $this->file->address = $immunization['address'];
      $this->file->age = $this->get_week($immunization['birthdate'])." weeks";
      $this->file->sex = $this->get_sex($immunization['sex']);
      $this->file->personnel = $this->name_format($personnel['firstname'],$personnel['lastname'],$personnel['middlename'],true);
      $this->file->data = $vaccination;
      $this->file->vaccines = $vaccines;
      $this->file->generate();
    }

  }
