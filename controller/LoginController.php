<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 12:03
 */
include ('../model/LoginModel.php');
class LoginController extends LoginModel {
  public $model;
  
 public function __construct()  
    {  
        $this->model = new LoginModel();

    } 
 
 public function invoke()
 {

  $result = $this->model->getlogin();   
  if($result == 'login')
  { ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/home.php";
  </script>
  <? }
  else
  {  ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?  }
  
 }
}
