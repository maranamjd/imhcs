<?php
  /**
   *
   */
   //require models
   require 'models/Vaccination.php';
   require 'models/Immunization_Record.php';

  class VaccinationController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->vaccination = new Vaccination();
      $this->immunization_record = new Immunization_Record();
    }

    public function create(){
      $this->vaccination->columns = [
        'vaccination_id' => null,
        'immunization_record_id' => $_POST['immunization_record_id'],
        'vaccine_id' => $_POST['vaccine_id'],
        'user_id' => $this->session->get('user_id'),
        'doses' => $_POST['doses'],
        'date' => date('Y-m-d'),
        'remarks' => $_POST['remarks'],
        'vaccination_level' => $_POST['vaccination_level']
      ];
      $result = $this->vaccination->save();
      if ($_POST['next_level'] == 1) {
        $this->immunization_record->update([
          'vaccination_level' => $_POST['vaccination_level'] + 1
        ], "immunization_record_id = ".$_POST['immunization_record_id']);
      }
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->vaccination->select(['*'], "vaccination_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->vaccination->update([
            'doses' => $_POST['doses'],
            'remarks' => $_POST['remarks'],
          ], "vaccination_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->vaccination->update(['active' => 0], "vaccination_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
