<?php

  /**
   *
   */
  class Controller extends Helper
  {

    function __construct()
    {
      // echo 'main controller<br>';
      $this->view = new View();
      $this->helper = new Helper();
      $this->session = new Session();
      $this->hash = new Hash();
      $this->auth = new Auth();
    }



    public function get_stock_code(){
      $today = date('Ymd');
      $code = $this->med_supply->select(['MAX(stock_code) as stock_code'], "stock_code LIKE '%$today%'");
      if ($this->count($code) > 0) {
        return ++$code[0]['stock_code'];
      }else {
        return $today.'001';
      }
    }



    public function redirect($url){
      header('Location: '.URL.$url);
    }

    public function setPage($page){
      $this->view->page = $page;
    }

    function _get_info(){
      $user = $this->user->find("user_id = '$this->user_id'");
      $details = $this->user_details->find("user_id = '$this->user_id'");
      return [
        'user' => $user,
        'details' => $details
      ];
    }


    function response($res){
      echo json_encode($res);
    }

    function get_patient_id(){
      $patient = $this->patient->select(['max(patient_id) as patient_id'], '1')[0]['patient_id'];
      if ($patient == null) {
        return "P000000001";
      }else {
        $id = str_replace('P', '1', $patient);
        return substr_replace($id, 'P'.substr($id+1, 1), 0);
      }
    }
  }
