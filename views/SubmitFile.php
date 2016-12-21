<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 17-11-2016
 * Time: 16:27
 */
session_start();
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