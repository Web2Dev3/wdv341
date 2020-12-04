<?php 

class UserValidator {

  private $data;
  private $errors = [];
  private static $fields = ['presenter_first_name', 'presenter_last_name', 'presenter_num', 'presenter_zip', 'presenter_email'];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public function validateForm(){

    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("'$field' is not present in the data");
        return;
      }
    }

    $this->validateUsername();
    $this->validateName();
    $this->validateNum();
    $this->validateZip();
    $this->validateEmail();
    return $this->errors;

  }

  private function validateUsername(){

    $val = trim($this->data['presenter_first_name']);

    if(empty($val)){
      $this->addError('presenter_first_name', 'Request cannot be empty');
    } else {
      if(strlen($val) > 200 || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $val)){
        $this->addError('presenter_first_name','Request cannot have special characters or be more than 200 characters.');
      }
    }

  }
  
   private function validateName(){

    $val = trim($this->data['presenter_last_name']);

    if(empty($val)){
      $this->addError('presenter_last_name', 'Name cannot be empty');
    } else {
      if(strlen($val) > 200 || !preg_match('/^[a-zA-Z0-9 \-_]*$/', $val)){
        $this->addError('presenter_last_name','Name cannot have special characters.');
      }
    }

  }
  
   private function validateNum(){

    $val = trim($this->data['presenter_num']);

    if(empty($val)){
      $this->addError('presenter_num', 'Phone cannot be empty');
    } else {
      if(!preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/', $val)){
        $this->addError('presenter_num','Invalid number');
      }
    }

  }
  
   private function validateZip(){

    $val = trim($this->data['presenter_zip']);

    if(empty($val)){
      $this->addError('presenter_zip', 'Zip cannot be empty');
    } else {
      if(!preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/', $val)){
        $this->addError('presenter_zip','Invalid Zip');
      }
    }

  }

  private function validateEmail(){

    $val = trim($this->data['presenter_email']);

    if(empty($val)){
      $this->addError('presenter_email', 'email cannot be empty');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('presenter_email', 'email must be a valid email address');
      }
    }

  }

  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>