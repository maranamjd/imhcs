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
   require 'models/Lab_Test.php';
   require 'models/Vaccine.php';
   require 'models/Supplier.php';
   require 'models/Med_Supply.php';
   require 'models/Checkup.php';
   require 'models/Immunization_Record.php';

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
      $this->lab_test = new Lab_Test();
      $this->vaccine = new Vaccine();
      $this->supplier = new Supplier();
      $this->med_supply = new Med_Supply();
      $this->checkup = new Checkup();
      $this->immunization_record = new Immunization_Record();
      $this->user_id = $this->session->get('user_id');
      $this->view->info = $this->_get_info();
    }

    public function chart(){
      $this->auth->special();
      if (!isset($_POST['key'])) {
        $this->error();
      }



      //disease
      $result = $this->checkup->select(['DISTINCT diagnosis'], 'active = 1');
      foreach ($result as $diagnosis) {
        $cases[$diagnosis['diagnosis']] = $this->checkup->count("diagnosis = '".$diagnosis['diagnosis']."'");
      }
      arsort($cases);
      $i = 1;
      $diseases = ['others' => 0];
      foreach ($cases as $key => $value) {
        if ($i < 4) {
          $diseases[$key] = $value;
        }else {
          $diseases['others'] += $value;
        }
        $i++;
      }
      // $this->response($cases);




      //checkups
      $gender = [
        'male' => $this->count($this->checkup->join('patient', 'patient_id', "sex = 1 AND checkup.active = 1")),
        'female' => $this->count($this->checkup->join('patient', 'patient_id', "sex = 2 AND checkup.active = 1"))
      ];
      // $this->response($gender);


      // age
      $patients = $this->patient->select(['birthdate'], "active = 1");
      $below = 0; $teen = 0; $adult = 0; $senior = 0;
      foreach ($patients as $patient) {
        $age = $this->get_age($patient['birthdate']);
        if ($age < 13) {
          $below++;
        }elseif ($age > 12 && $age < 20) {
          $teen++;
        }elseif ($age > 19 && $age < 60) {
          $adult++;
        }else {
          $old++;
        }
      }
      $ages = [
        'below' => $below,
        'teen' => $teen,
        'adult' => $adult,
        'senior' => $senior
      ];
      // $this->response($ages);




      //number of patients
      $patients = $this->patient->select(['created_on'], "active = 1");
      $number_patients = [
        'January' => [],
        'February' => [],
        'March' => [],
        'April' => [],
        'May' => [],
        'June' => [],
        'July' => [],
        'August' => [],
        'September' => [],
        'October' => [],
        'November' => [],
        'December' => []
      ];
      foreach ($patients as $patient) {
        $number_patients[date('F', strtotime($patient['created_on']))][] = 1 ;
      }
      foreach ($number_patients as $key => $value) {
        $number_patients[$key] = $this->count($value);
      }
      // $this->response($number_patients);


      $this->response([
        'diseases' => $diseases,
        'gender' => $gender,
        'ages' => $ages,
        'number_patients' => $number_patients
      ]);

    }

    public function index(){
      //custom page css/js
      $this->view->js = ['admin/js/dashboard.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = [
        'doctor' => $this->user->count('user_type = 1 AND active = 1'),
        'nurse' => $this->user->count('user_type = 2 AND active = 1'),
        'laboratorist' => $this->user->count('user_type = 3 AND active = 1'),
        'pharmacist' => $this->user->count('user_type = 4 AND active = 1'),
        'patient' => $this->patient->count('active = 1'),
        'medicine' => $this->medicine->count('active = 1'),
        'immunization' => $this->immunization_record->count('active = 1')
      ];
      $this->view->low_stock = $this->medicine->select(['name'], "stock <= 100 AND active = 1");
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
    public function lab(){
      $this->view->js = ['admin/js/lab.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->lab_test->select(['*'], "active = 1");

      $this->view->render('admin/lab_test', 'admin/inc');
    }
    public function report(){
      $this->view->js = ['admin/js/report.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->render('admin/report', 'admin/inc');
    }
    public function configuration(){
      $this->view->js = ['admin/js/default.js'];
      $this->view->css = ['admin/css/default.css'];

      $this->view->render('admin/configuration', 'admin/inc');
    }

    public function vaccine(){
      $this->view->js = ['admin/js/vaccine.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->vaccine->select(['*'], "active = 1");

      $this->view->render('admin/vaccine', 'admin/inc');
    }


    public function supplier(){
      $this->view->js = ['admin/js/supplier.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->supplier->select(['*'], "active = 1");

      $this->view->render('admin/supplier', 'admin/inc');
    }

    public function inventory(){
      $this->view->js = ['admin/js/inventory.js'];
      $this->view->css = ['admin/css/default.css'];
      $this->view->data = $this->medicine->join('med_category', 'category_id', "medicine.active = 1");
      $this->view->supplier = $this->supplier->select(['*'], "active = 1");
      $this->view->low_stock = $this->medicine->select(['name'], "stock <= 100 AND active = 1");

      $this->view->render('admin/inventory', 'admin/inc');
    }

  }
