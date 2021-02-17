<?php
  /**
   *
   */
   //require models
   require 'models/User.php';

  class UserController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      //create instance of a model
      $this->user = new User();
    }

    public function create(){
      // $user_id = $this->get_id();
      // $this->user->columns = [
      //   'user_id' => $user_id,
      //   'image' => 'unknown.png',
      //   'email' => $_POST['email'],
      //   'password' => $this->hash->encrypt($_POST['email']),
      //   'user_type' => $_POST['user_type'],
      // ];
      // $result = $this->user->save();
      // if ($result) {
      //   $this->user_details->columns = [
      //     'id' => null,
      //     'user_id' => $user_id,
      //     'firstname' => $_POST['firstname'],
      //     'middlename' => $_POST['middlename'] == '' ? null : $_POST['middlename'],
      //     'lastname' => $_POST['lastname'],
      //     'address' => $_POST['address'],
      //     'birthdate' => $_POST['birthdate'],
      //     'contact_info' => $_POST['contact_number'],
      //     'sex' => $_POST['sex']
      //   ];
      //   $this->user_details->save();
      //   $this->response(['res' => 1, 'message' => 'Successfuly Added!']);
      // }else {
      //   $this->response(['res' => 1, 'message' => $result]);
      // }
    }

    public function edit(){
      // $id = $_POST['id'];
      // $result = $this->user->join('user_details', 'user_id', "id = $id");
      // $this->response($result[0]);
    }

    public function update(){
      // $id = $_POST['id'];
      // switch ($_POST['type']) {
      //   case 1:
      //     $result = $this->user_details->update([
      //       'firstname' => $_POST['firstname'],
      //       'middlename' => $_POST['middlename'] == '' ? null : $_POST['middlename'],
      //       'lastname' => $_POST['lastname'],
      //       'address' => $_POST['address'],
      //       'birthdate' => $_POST['birthdate'],
      //       'sex' => $_POST['sex'],
      //     ], "user_id = '$id'");
      //     if ($result) {
      //       $this->response(['res' => 1, 'message' => 'Successfuly Updated!']);
      //     }else {
      //       $this->response(['res' => 1, 'message' => $result]);
      //     }
      //     break;

      //   case 2:
      //     $result = $this->user->update(['active' => 0], "user_id = '$id'");
      //     if ($result) {
      //       $this->response(['res' => 1, 'message' => 'Successfuly Deleted!']);
      //     }else {
      //       $this->response(['res' => 1, 'message' => $result]);
      //     }
      //     break;
      // }
    }

    public function login(){
      $username = $_POST['username'];
      $password = $_POST['password'];

      $result = $this->user->select(['*'], "email = '$username'");
      if (!empty($result)) {
        if ($this->hash->decrypt($result[0]['password']) == $password) {
          $this->session->set([
            'user_id' => $result[0]['user_id'],
            'user_type' => $result[0]['user_type']
          ]);
          $this->response(['res' => 1]);
          exit;
        }
      }
      $this->response(['res' => 0, 'message' => 'Username or Password do not match!']);
    }

    public function logout(){
      $this->auth->scan();
      $this->session->destroy();
      header('Location: '.URL);
    }

  }
