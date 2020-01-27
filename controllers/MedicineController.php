<?php
  /**
   *
   */
   //require models
   require 'models/Medicine.php';

  class MedicineController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->medicine = new Medicine();
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

  }
