<?php
session_start();

 if(empty($_SESSION['UNAME']))
{ ?>
  <script>
window.location = "http://sangifashions.com/to_do_list/views/login.php";
  </script>
  <?
}
$tempPrice = isset($_SESSION['rate']) ? $_SESSION['rate']:"";
$tempStoreError = isset($_SESSION['storeError']) ? true : false;
$tempStoreId = isset($_SESSION['storeIid']) ? $_SESSION['storeIid'] :"";

/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 11-11-2016
 * Time: 14:30
 */
include ("../model/storeModel.php");
$confirmObj = new storeModel();
$store_name = $confirmObj->store_name();
$name=$confirmObj->fetchStoreName();
?>
<html xmlns="http://www.w3.org/1999/html">

<head>
<title>ConfirfmPage</title>
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

    <form action="" method="post">
        <div class="container-fluid col-lg-8 col-xs-offset-2">
            <table class="table table-striped table-bordered">
                <tr>
                    <td class="hide"><input type="hidden" name="id" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; }?>"></td>
                    <script type="text/javascript" src="../js/jquery.js"></script>
                    <td colspan="2">
                        <?php $productName=$confirmObj->fetchForConfirm($_GET['id'])?>
                        <div class="text-center">
                        <label>Product:<?php echo $productName['name']?></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Store:
                    </td>

                    <td>
                        <select name="store" >
                            <option value="-1">--Select store--</option>
                            <?php
                            foreach ($store_name['isQuery'] as $name):?>
                                    <option  value=<?php echo $name['id']?>
                                    <?php if($tempStoreId && $tempStoreId == $name['id']){?> selected <?php }?>>
                                        <?php
                                        echo $name['store_name']//name =store[name]
                                        ?>
                                    </option>

                            <?php  endforeach;
                            ?>
                        </select>
                        didn't find your store <a href="store.php?redirect=addItem&key=<?php echo $_GET['id']?>">Add store</a>
                    <?php if($tempStoreError) { ?> <span class="text-danger">Please select a store</span> <?php }
                    ?>
                </tr>
                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <input type="number" value="<?php echo $tempPrice ?>" name="price" placeholder="price">
                        <?php if(isset($_SESSION['priceError']) && $_SESSION['priceError']){?>
                            <span class="text-danger">Recheck the price</span><?php }?>
                        <script type="text/javascript" src="../js/changeFieldColor.js"></script>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="home.php"><span class="btn btn-primary">Cancel</span></a>
                    </td>
                        <td><div ><input type="submit" class="text-center btn btn-primary"  name="submit" value="Submit"></div></td>
                    <script type="text/javascript" src="../js/submit.js"></script>
                </tr>
            </table>
        </div>
    </form>
</body>
</html>
<?php

//print_r($date);
if(isset($_POST['submit']))
{
     //$name_of_store=$_POST['store_name'];
     //$store_address=$_POST['address'];
    $price=$_POST['price'];
    $storeId = trim($_POST['store']);
    $_SESSION['rate'] = $price;
    $id=$_POST['id'];
    $store_id=$_POST['store'];
     //var_dump($store_id);
    $setdate =  date("Y-m-d");
    $_SESSION['storeIid']=$store_id;
    if($storeId == -1){
        $_SESSION['storeError'] = true;
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . "confirm.php?id=$id" . '">';
        exit();
    }
    else
    {
        $_SESSION['storeIid'] = $store_id;
    }
    if($price == "" || $price == 0)
    {
        if(isset($_POST['id']))
        {
            $_SESSION['priceError'] = true;
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . "confirm.php?id=$id" . '">';
        }
        //echo "<script>alert('price must be add')</script>";
        exit();
    }
    try
    {
        if($confirmObj->bought($id, $price, $store_id, $setdate))
        {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . "home.php" . '">';
                //   header('location: home.php');
        }
    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }
}

?>