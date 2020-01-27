<?php

  /**
   *
   */
  class Session
  {

    function __construct()
    {
      // code...
    }
    public static function init(){
        session_start();
    }

    public static function set($data){
      foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
      }
    }
    public static function get($data){
      $count = is_array($data) ? sizeof($data) : 1;
      if ($count < 2) {
        if (isset($_SESSION[$data])) {
          return $_SESSION[$data];
        }
      }else {
        $sessionData = array();
        foreach ($data as $key => $value) {
          if (isset($_SESSION[$value])) {
            $sessionData[$value] = $_SESSION[$value];
          }
        }
        return $sessionData;
      }
    }

    public static function destroy(){
      // unset($_SESSION);
      session_destroy();
    }
  }
