<?php
  /**
   *
   */
  class Auth
  {

    function __construct()
    {

    }

    function scan(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype == 1) {
          header('Location: '.URL.'doctor');
        }elseif ($usertype == 2) {
          header('Location: '.URL.'nurse');
        }elseif ($usertype == 3) {
          header('Location: '.URL.'laboratorist');
        }elseif ($usertype == 4) {
          header('Location: '.URL.'pharmacist');
        }elseif ($usertype == 5) {
          header('Location: '.URL.'admin');
        }else {
          return false;
        }
      }
    }

    function special(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        return false;
      }else {
        header('Location: '.URL);
      }
    }

    function doctor(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype != 1) {
          header('Location: '.URL);
        }else {
          return false;
        }
      }else {
        header('Location: '.URL);
      }
    }

    function nurse(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype != 2) {
          header('Location: '.URL);
        }else {
          return false;
        }
      }else {
        header('Location: '.URL);
      }
    }

    function laboratorist(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype != 3) {
          header('Location: '.URL);
        }else {
          return false;
        }
      }else {
        header('Location: '.URL);
      }
    }

    function pharmacist(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype != 4) {
          header('Location: '.URL);
        }else {
          return false;
        }
      }else {
        header('Location: '.URL);
      }
    }

    function admin(){
      $usertype = Session::get('user_type');
      if ($usertype !== null) {
        if ($usertype != 5) {
          header('Location: '.URL);
        }else {
          return false;
        }
      }else {
        header('Location: '.URL);
      }
    }

  }
