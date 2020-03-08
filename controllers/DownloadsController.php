<?php
  /**
   *
   */
   //require models
   require 'libs/downloads/Prescription.php';
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Patient.php';
   require 'models/Medicine.php';
   require 'models/Med_Category.php';
   require 'models/Checkup.php';
   require 'models/Prescription.php';

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
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function prescription($id){
      $checkup = $this->checkup->select(['patient_id', 'notes'], "checkup_id = $id");
      $personnel = $this->user_details->select(['firstname', 'middlename', 'lastname'], "user_id = '$this->user_id'")[0];
      $prescription = $this->prescription->join('medicine', 'med_id', "prescription.active = 1 AND checkup_id = $id");
      $patient = $this->patient->select(['*'], "patient_id = '".$checkup[0]['patient_id']."'")[0];

      $this->file = new PrescriptionFile();
      $this->file->patient_name = $this->name_format($patient['firstname'],$patient['lastname'],$patient['middlename'],true);
      $this->file->address = $patient['address'];
      $this->file->age = $this->get_age($patient['birthdate']);
      $this->file->sex = $this->get_sex($patient['sex']);
      $this->file->note = $checkup[0]['notes'];
      $this->file->personnel = $this->name_format($personnel['firstname'],$personnel['lastname'],$personnel['middlename'],true);
      $this->file->data = $prescription;
      $this->file->generate();
    }

  }
