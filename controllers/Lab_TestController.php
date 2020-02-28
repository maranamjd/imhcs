<?php
  /**
   *
   */
   //require models
   require 'models/Lab_Test.php';

  class Lab_TestController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->lab_test = new Lab_Test();
    }

    public function create(){
      $this->lab_test->columns = [
        'description' => $_POST['description']
      ];
      $result = $this->lab_test->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->lab_test->select(['*'], "lab_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->lab_test->update([
            'description' => $_POST['description'],
          ], "lab_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->lab_test->update(['active' => 0], "lab_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
