<?php 
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 12:03
 */
include ('../app/dbConnector.php');
class LoginModel extends dbConnector {
    protected $connectDb;

    public function __construct()
    {
        $this->connectDb = $this->connect();
    }



 public function getlogin()
 {
  // here goes some hardcoded values to simulate the database
  if(isset($_REQUEST['u']) && isset($_REQUEST['p'])){
  
   if($_REQUEST['u']=='admin' && $_REQUEST['p']=='admin'){
 session_start();
  $_SESSION['UNAME'] = $_REQUEST['u'];
  
    return 'login';
   }
                        else{
    return 'invalid user';
   }
  }
 }
 
}