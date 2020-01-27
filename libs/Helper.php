<?php
  /**
   *
   */
  class Helper
  {

    public function count($data){
      return is_array($data) ? count($data) : 0;
    }

    public function name_format($firstname, $lastname, $middlename = null, $middleinitial = false){
      $name = ucwords(strtolower($firstname)).' '.ucwords(strtolower($middlename)).' '.ucwords(strtolower($lastname));
      if ($middleinitial) {
        $name = ucwords(strtolower($firstname)).' '.strtoupper($middlename[0]).'. '.ucwords(strtolower($lastname));
        if ($middlename === null) {
          $name = ucwords(strtolower($firstname)).' '.ucwords(strtolower($lastname));
        }
      }
      return $name;
    }

    public function get_age($birthday){
      return floor((time() - strtotime($birthday)) / 31556926);
    }

    public function get_sex($sex){
      return ($sex == 1) ? 'Male' : 'Female';
    }

    public function get_id(){
      $letters = '';
    	$numbers = '';
    	foreach (range('A', 'Z') as $char) {
    	    $letters .= $char;
    	}
    	for($i = 0; $i < 10; $i++){
    		$numbers .= $i;
    	}
    	return substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
    }

  }
