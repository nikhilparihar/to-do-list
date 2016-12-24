<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();

 if(empty($_SESSION['UNAME']))
{ ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?
}
