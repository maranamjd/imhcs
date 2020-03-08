<?php
  /**
   *
   */
   //require models
   require 'models/Vaccination.php';

  class VaccinationController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->vaccination = new Vaccination();
    }

    public function create(){
      $this->vaccination->columns = [
        'vaccination_id' => null,
        'immunization_record_id' => $_POST['immunization_record_id'],
        'vaccine_id' => $_POST['vaccine_id'],
        'user_id' => $this->session->get('user_id'),
        'doses' => $_POST['doses'],
        'date' => date('Y-m-d'),
        'remarks' => $_POST['remarks']
      ];
      $result = $this->vaccination->save();
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
