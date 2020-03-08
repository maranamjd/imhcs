<?php
  /**
   *
   */
   //require models
   require 'models/Immunization_Record.php';

  class Immunization_RecordController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->immunization_record = new Immunization_Record();
    }

    public function create(){
      $this->immunization_record->columns = [
        'immunization_record_id' => null,
        'child_name' => $_POST['child_name'],
        'mother_name' => $_POST['mother_name'],
        'father_name' => $_POST['father_name'],
        'address' => $_POST['address'],
        'birthdate' => $_POST['birthdate'],
        'birthplace' => $_POST['birth_place'],
        'birth_height' => $_POST['birth_height'],
        'birth_weight' => $_POST['birth_weight'],
        'sex' => $_POST['sex'],
        'created_on' => date('Y-m-d')
      ];
      $result = $this->immunization_record->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->immunization_record->find("immunization_record_id = $id");
      $this->response($result);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->immunization_record->update([
            'child_name' => $_POST['child_name'],
            'mother_name' => $_POST['mother_name'],
            'father_name' => $_POST['father_name'],
            'address' => $_POST['address'],
            'birthdate' => $_POST['birthdate'],
            'birthplace' => $_POST['birth_place'],
            'birth_height' => $_POST['birth_height'],
            'birth_weight' => $_POST['birth_weight'],
            'sex' => $_POST['sex'],
          ], "immunization_record_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->immunization_record->update(['active' => 0], "immunization_record_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
