<?php
session_start();

 if(empty($_SESSION['UNAME']))
{ ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?
}
$tempItemName = isset($_SESSION['itemName']) ? $_SESSION['itemName']:"";
$tempItemQuantity = isset($_SESSION['itemQuantity']) ? $_SESSION['itemQuantity']:"";
$tempItemDesc = isset($_SESSION['itemDesc']) ? $_SESSION['itemDesc']:"";
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 10:45
 */
include ('../model/itemModel.php');
$itemModal = new itemModel();
?>

<html>
<head>
<title>ItemPage</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>

<nav class="navbar navbar-inverse navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="font-size:35px ">To Do List</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php"><span class="btn btn-primary" >Home</a></span> </li>
        </ul>
    </div>
</nav>

<form method="post" action="item.php">
    <div class="container-fluid col-lg-8 col-xs-offset-2">
        <table class="table table-striped table-bordered">
            <tr>
                <td>
                    Name of product:<span class="text-danger">*</span>
                </td>
                <td>
                    <input type="text" name="product_name" placeholder="Name of product" value="<?php echo $tempItemName ?>" >
                    <script type="text/javascript" src="../js/jquery.js"></script>
                    <script type="text/javascript" src="../js/changeFieldColor.js"></script>
                 <?php if(isset($_SESSION['itemNameError']) && $_SESSION['itemNameError']){ ?>
                    <span class="text-danger">PLease fill the item name</span> <?php }?>

                </td>
            </tr>
            <tr>
                <td>
                    Description(optional):
                </td>
                <td>
                    <textarea name="description"></textarea>
                    <script type="text/javascript" src="../js/changeFieldColor.js"></script>

                </td>
            </tr>
            <tr>
                <td>
                    Quantity:<span class="text-danger">*</span>
                </td>
                <td>
                    <input type="text" name="quantity" value="<?php echo $tempItemQuantity?>"<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : '' ?>" placeholder="Enter quantity">
                    <script type="text/javascript" src="../js/changeFieldColor.js"></script>

                    <?php if(isset($_SESSION['itemQuantityError']) && $_SESSION['itemQuantityError']){?>

                <span class="text-danger">Please fill the quantity</span><?php }?>

                </td>
            </tr>

        </table>
            <div class="text-center">
                <input  type="submit" id="submit" align="center" class="btn btn-primary" name="submit">
            </div>

    </div>
</form>
</body>
</html>


<?php

    if(isset($_POST['submit'])) {
        $item_name = $_POST['product_name'];
        $_SESSION['itemName'] = $item_name;
        $item_desc = $_POST['description'];
        $item_quantity = $_POST['quantity'];
        $_SESSION['itemQuantity'] = $item_quantity;
        $_SESSION['itemDesc'] = $item_desc;

        try {
            // $item_insert_query="INSERT INTO item (name, description, quantity) VALUES ('$item_name','$item_desc','$item_quantity')";
            $table = 'item';
            $data = [
                "name" => $item_name,
                "description" => $item_desc,
                "quantity" => $item_quantity
            ];

            if ($item_name == "") {
               $_SESSION['itemNameError'] = true;
               // echo "<script>alert('Required entries must be fill')</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL='."item.php".'">';
                exit;
               // exit();
            }
            if($item_quantity == "")
            {
                $_SESSION['itemQuantityError'] = true;
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL='."item.php".'">';
                exit();
            }
            if($item_name == "" && $item_quantity == ""){
                $_SESSION['itemQuantityError'] = true;
                $_SESSION['itemNameError'] = true;
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL='."item.php".'">';
                exit();
            }
            // $sql=$itemModal->insert($table, $data);
            if ($itemModal->insert($table, $data)) {
                echo "<script>alert('item added')</script>";
                header("location:home.php");
            } else {
                echo "<script>alert('item is not added')</script>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
}
?>
