<?php
  /**
   *
   */
   require 'models/Medication.php';


  class MedicationController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->special();
      $this->medication = new Medication();
      $this->user_id = $this->session->get('user_id');
    }

    public function create(){
      $this->medication->columns = [
        'medication_id' => null,
        'user_id' => Session::get('user_id'),
        'patient_id' => $_POST['patient_id'],
        'med_id' => $_POST['med_id'],
        'quantity' => $_POST['quantity']
      ];
      $result = $this->medication->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }
    }


    public function edit(){
      $id = $_POST['id'];
      $result = $this->medication->join('patient', 'patient_id', "medication_id = $id")[0];
      $this->response($result);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->medication->update([
            'med_id' => $_POST['med_id'],
            'quantity' => $_POST['quantity']
          ], "medication_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->medication->update(['status' => 2], "medication_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Request Cancelled!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 3:
          $result = $this->medication->update([
            'status' => 1,
            'date_updated' => date('Y-m-d H:i:s')
          ], "medication_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Request Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }



  }
