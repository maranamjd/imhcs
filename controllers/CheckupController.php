<?php
  /**
   *
   */
   require 'models/Checkup.php';


  class CheckupController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->Doctor();
      $this->checkup = new Checkup();
      $this->user_id = $this->session->get('user_id');
    }

    public function create(){
      $this->checkup->columns = [
        'checkup_id' => null,
        'patient_id' => $_POST['patient_id'],
        'user_id' => $this->user_id,
        'blood_pressure' => $_POST['blood_pressure'],
        'temperature' => $_POST['temperature'],
        'pulse_rate' => $_POST['pulse_rate'],
        'respiration_rate' => $_POST['respiration_rate'],
        'weight' => $_POST['weight'],
        'height' => $_POST['height'],
        'symptoms' => $_POST['symptoms'] == '' ? null : $_POST['symptoms'],
        'diagnosis' => $_POST['diagnosis'] == '' ? null : $_POST['diagnosis'],
        'date' => date('Y-m-d'),
        'notes' => $_POST['notes'] == '' ? null : $_POST['notes'],
      ];
      $result = $this->checkup->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }
    }


    public function edit(){
      $id = $_POST['id'];
      $result = $this->checkup->find("checkup_id = $id");
      $this->response($result);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->checkup->update([
            'blood_pressure' => $_POST['blood_pressure'],
            'temperature' => $_POST['temperature'],
            'pulse_rate' => $_POST['pulse_rate'],
            'respiration_rate' => $_POST['respiration_rate'],
            'weight' => $_POST['weight'],
            'height' => $_POST['height'],
            'symptoms' => $_POST['symptoms'],
            'diagnosis' => $_POST['diagnosis'],
            'notes' => $_POST['notes'],
          ], "checkup_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->checkup->update(['active' => 0], "checkup_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }



  }
