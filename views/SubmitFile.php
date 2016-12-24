<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 17-11-2016
 * Time: 16:27
 */
session_start();

 if(empty($_SESSION['UNAME']))
{ ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?
}
include ('../model/itemModel.php');
$itemModal = new itemModel();
$table = 'item';
        $data = [
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "quantity" => $_POST['quantity']
        ];
if($itemModal->insert($table, $data))
{
    echo "success";
}
?>