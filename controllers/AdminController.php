<?php
  /**
   *
   */
   //require models
   require 'models/User.php';
   require 'models/User_Details.php';
   require 'models/Patient.php';
   require 'models/Medicine.php';
   require 'models/Med_Category.php';

  class AdminController extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->auth->admin();
      //create instance of a model
      $this->user = new User();
      $this->user_details = new User_Details();
      $this->patient = new Patient();
      $this->medicine = new Medicine();
      $this->med_category = new Med_Category();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function index(){
      //custom page css/js
      $this->view->js = ['admin/js/default.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = [
        'doctor' => $this->user->count('user_type = 1 AND active = 1'),
        'nurse' => $this->user->count('user_type = 2 AND active = 1'),
        'laboratorist' => $this->user->count('user_type = 3 AND active = 1'),
        'pharmacist' => $this->user->count('user_type = 4 AND active = 1'),
        'patient' => $this->patient->count('active = 1'),
        'medicine' => $this->medicine->count('active = 1')
      ];

      //render page
      $this->view->render('admin/index', 'admin/inc');
    }

    public function doctor(){
      $this->view->js = ['admin/js/doctor.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->data = $this->user->join('user_details', 'user_id', "user_type = 1 AND active = 1");

      $this->view->render('admin/doctor', 'admin/inc');
    }

    public function nurse(){
      $this->view->js = ['admin/js/nurse.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->user->join('user_details', 'user_id', "user_type = 2 AND active = 1");

      $this->view->render('admin/nurse', 'admin/inc');
    }
    public function laboratorist(){
      $this->view->js = ['admin/js/laboratorist.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->user->join('user_details', 'user_id', "user_type = 3 AND active = 1");

      $this->view->render('admin/laboratorist', 'admin/inc');
    }
    public function pharmacist(){
      $this->view->js = ['admin/js/pharmacist.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->user->join('user_details', 'user_id', "user_type = 4 AND active = 1");

      $this->view->render('admin/pharmacist', 'admin/inc');
    }
    public function medicine(){
      $this->view->js = ['admin/js/medicine.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->data = $this->medicine->join('med_category', 'category_id', "medicine.active = 1");
      $this->view->category = $this->med_category->select(['*'], "active = 1");

      $this->view->render('admin/medicine', 'admin/inc');
    }
    public function category(){
      $this->view->js = ['admin/js/category.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->med_category->select(['*'], "active = 1");

      $this->view->render('admin/category', 'admin/inc');
    }
    public function report(){
      $this->view->js = ['admin/js/default.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->render('admin/report', 'admin/inc');
    }
    public function configuration(){
      $this->view->js = ['admin/js/default.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->render('admin/configuration', 'admin/inc');
    }

  }
