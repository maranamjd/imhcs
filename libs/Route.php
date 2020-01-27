<?php
  /**
   *
   */
  class Route
  {

    function __construct()
    {
      $this->error = new Excptn();
      $this->url = isset($_GET['url']) ? $_GET['url'] : '/';
      $this->arg = count(explode('/', rtrim('/', $this->url))) > 2 ? explode('/', rtrim('/', $this->url))[2] : null;
      // $this->full_url = rtrim($url, '/');
      // $this->url = explode('/', $this->full_url);
    }

    public function get($route, $action){
      $this->controller = explode('@', $action)[0];
      $this->method = explode('@', $action)[1];
      if ($route == $this->url) {
        $this->_setController();
        $this->_runMethod();
      }
    }




    private function _setController(){
      $file = 'controllers/'. $this->controller .'.php';
      if(file_exists($file)){
        require $file;
      }else {
        $this->error->show('Controller', "Cannot Find $this->controller!");
        return false;
      }
      $this->_controller = new $this->controller;
    }

    private function _runMethod(){
      if (method_exists($this->_controller, $this->method)) {
        if ($this->arg != null) {
          $this->_controller->{$this->method}($this->arg);
        }else {
          $this->_controller->{$this->method}();
        }
      }else {
        $this->error->show('Method', "$this->method does not exists in $this->controller!");
        return false;
      }
      // if (isset($url[2])){
      // }else {
      //   $url[1] = isset($url[1]) ? $url[1] : 'index';
      //   if (method_exists($controller, $url[1])) {
      //     $controller->{$url[1]}();
      //   }else {
      //     $this->error();
      //     return false;
      //   }
      // }
    }

  }
