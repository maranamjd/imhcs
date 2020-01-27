<?php
  /**
   *
   */
   //require models
   require 'models/Med_Category.php';

  class Med_CategoryController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->med_category = new Med_Category();
    }

    public function create(){
      $this->med_category->columns = [
        'description' => $_POST['description']
      ];
      $result = $this->med_category->save();
      if ($result) {
        $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      }else {
        $this->response(['res' => 0, 'message' => $result]);
      }
    }

    public function edit(){
      $id = $_POST['id'];
      $result = $this->med_category->select(['*'], "category_id = $id");
      $this->response($result[0]);
    }

    public function update(){
      $id = $_POST['id'];
      switch ($_POST['type']) {
        case 1:
          $result = $this->med_category->update([
            'description' => $_POST['description'],
          ], "category_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;

        case 2:
          $result = $this->med_category->update(['active' => 0], "category_id = $id");
          if ($result) {
            $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
          }else {
            $this->response(['res' => 1, 'message' => $result]);
          }
          break;
      }
    }

  }
