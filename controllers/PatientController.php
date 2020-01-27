<?php
  /**
   *
   */
   //require models
   require 'models/Patient.php';

  class PatientController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->patient = new Patient();
    }

    public function create(){
      $this->patient->columns = [
        'id' => null,
        'patient_id' => Helper::get_id(),
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'] == '' ? null : $_POST['middlename'],
        'lastname' => $_POST['lastname'],
        'address' => $_POST['address'],
        'birthdate' => $_POST['birthdate'],
        'contact_info' => $_POST['contact_number'],
        'sex' => $_POST['sex'],
        'created_on' => date('Y-m-d')
      ];
      $result = $this->patient->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->patient->find("id = $id");
      $this->response($result);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->patient->update([
            'firstname' => $_POST['firstname'],
            'middlename' => $_POST['middlename'] == '' ? null : $_POST['middlename'],
            'lastname' => $_POST['lastname'],
            'address' => $_POST['address'],
            'birthdate' => $_POST['birthdate'],
            'contact_info' => $_POST['contact_number'],
            'sex' => $_POST['sex'],
          ], "id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->patient->update(['active' => 0], "id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }


  }
