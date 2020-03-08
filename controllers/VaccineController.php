<?php
  /**
   *
   */
   //require models
   require 'models/Vaccine.php';

  class VaccineController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->vaccine = new Vaccine();
    }

    public function create(){
      $this->vaccine->columns = [
        'name' => $_POST['name']
      ];
      $result = $this->vaccine->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->vaccine->select(['*'], "vaccine_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->vaccine->update([
            'name' => $_POST['name'],
          ], "vaccine_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->vaccine->update(['active' => 0], "vaccine_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
