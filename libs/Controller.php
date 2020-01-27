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

  }
