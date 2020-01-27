<?php
  /**
   *
   */
   //require models
   require 'models/Prescription.php';

  class PrescriptionController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->prescription = new Prescription();
    }

    public function create(){
      $this->prescription->columns = [
        'id' => null,
        'checkup_id' => $_POST['checkup_id'],
        'med_id' => $_POST['medicine'],
        'no_days' => $_POST['no_days'],
        'intake_schedule' => $_POST['intake_schedule'],
        'before_meal' => $_POST['before_meal']
      ];
      $result = $this->prescription->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->prescription->find("id = $id");
      $this->response($result);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->prescription->update([
            'med_id' => $_POST['medicine'],
            'no_days' => $_POST['no_days'],
            'intake_schedule' => $_POST['intake_schedule'],
            'before_meal' => $_POST['before_meal']
          ], "id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->prescription->update(['active' => 0], "id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }


  }
