<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 18-11-2016
 * Time: 16:23
 */
 session_start();

 if(empty($_SESSION['UNAME']))
{ ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?
}
include('../model/itemModel.php');
$itemModal = new itemModel();
$id = $_POST['id'];
$price = $_POST['price'];
$store_id = $_POST['store_id'];
if($itemModal->boughtModal($id, $price, $store_id))
{
    echo "success";
}
?>