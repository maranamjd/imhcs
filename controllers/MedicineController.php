<?php
  /**
   *
   */
   //require models
   require 'models/Medicine.php';
   require 'models/Prescription.php';
   require 'models/Medication.php';

  class MedicineController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->medicine = new Medicine();
      $this->prescription = new Prescription();
      $this->medication = new Medication();
    }

    public function create(){
      $this->medicine->columns = [
        'name' => $_POST['name'],
        'category_id'=> $_POST['category']
      ];
      $result = $this->medicine->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->medicine->join('med_category', 'category_id', "med_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->medicine->update([
            'name' => $_POST['name'],
            'category_id' => $_POST['category']
          ], "med_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->medicine->update(['active' => 0], "med_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

    public function get(){
      $id = $_POST['id'];
      $data = [];
      $medicines = $this->prescription->join('medicine', 'med_id', "prescription.active = 1 AND prescription.checkup_id = $id");
      foreach ($medicines as $medicine) {
        $medication = $this->medication->select(['medication_id'], "status = 0 AND med_id = ".$medicine['med_id']." AND checkup_id = ".$medicine['checkup_id']);
        if ($this->count($medication) < 1) {
          $data[] = $medicine;
        }
      }
      echo json_encode($data);
    }

  }
