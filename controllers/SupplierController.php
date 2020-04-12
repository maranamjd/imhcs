<?php
  /**
   *
   */
   //require models
   require 'models/Supplier.php';

  class SupplierController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->supplier = new Supplier();
    }

    public function create(){
      $this->supplier->columns = [
        'name' => $_POST['name'],
        'address' => $_POST['address']
      ];
      $result = $this->supplier->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->supplier->select(['*'], "supplier_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->supplier->update([
            'name' => $_POST['name'],
            'address' => $_POST['address']
          ], "supplier_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->supplier->update(['active' => 0], "supplier_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
