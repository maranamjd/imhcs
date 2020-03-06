<?php
  /**
   *
   */
   //require models
   require 'models/Lab_Request.php';

  class Lab_RequestController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->lab_request = new Lab_Request();
    }

    public function create(){
      $this->lab_request->columns = [
        'user_id' => Session::get('user_id'),
        'lab_id' => $_POST['lab_id'],
        'patient_id' => $_POST['patient_id'],
        'note' => $_POST['note']
      ];
      $result = $this->lab_request->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->lab_request->join('patient', 'patient_id', "lab_req_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->lab_request->update([
            'lab_id' => $_POST['lab_id'],
            'note' => $_POST['note'],
          ], "lab_req_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->lab_request->update(['status' => 2], "lab_req_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Cancelled!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 3:
          $result = $this->lab_request->update([
            'results' => $_POST['result'],
            'status' => 1,
            'date_updated' => date('Y-m-d H:i:s')
          ], "lab_req_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

      }
    }

  }
