<?php
  /**
   *
   */
   //require models
   require 'models/Med_Supply.php';
   require 'models/Medicine.php';

  class Med_SupplyController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->med_supply = new Med_Supply();
      $this->medicine = new Medicine();
    }

    public function add(){
      $med_id = $_POST['med_id'];
      $stock = $this->medicine->select(['stock'], "med_id = $med_id")[0]['stock'];
      $this->med_supply->columns = [
        'med_supply_id' => null,
        'med_id' => $med_id,
        'supplier_id' => $_POST['supplier_id'],
        'quantity' => $_POST['quantity'],
        'date' => date('Y-m-d')
      ];
      $result = $this->med_supply->save();
      if ($result) {
        $this->medicine->update([
          'stock' => $stock + $_POST['quantity'],
        ], "med_id = $med_id");
        $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
      }else {
        $this->response(['res' => 1, 'message' => $result]);
      }



    }

  }
