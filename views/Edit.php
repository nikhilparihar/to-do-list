<?php
session_start();
$tempNewName = isset($_SESSION['newName']) ? $_SESSION['newName']:"";
$tempNewQuantity = isset($_SESSION['newQuantity']) ? $_SESSION['newQuantity']:"";
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 10:45
 */
include ('../model/itemModel.php');
$object = new itemModel();
?>

<html>
<head>
    <title>EditPage</title>

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

<form method="post">
    <div class="container-fluid col-lg-8 col-xs-offset-2">
        <table class="table table-striped table-bordered">
            <tr>
                <td class="hide"><input type="hidden" name="id" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; }?>"></td>

                <td>
                    Name of product:
                </td>
                <?php $editObj=$object->FetchForEdit($_GET['id']);
                ?>
                <td>
                    <label><?php echo $editObj["name"]?></label>
                </td>

            </tr>
            <tr>
                <td>
                    Description(optional):
                </td>
                <td>
                    <textarea name="new_description" ><?php echo $editObj["description"]?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Quantity:
                </td>
                <td>
                    <input type="text"  name="new_quantity" <?php  if($tempNewQuantity){?>
                    value="<?php echo $tempNewName; } else{?>
                    value="<?php echo $editObj["quantity"]; }?>"
                    ">
                    <?php if(isset($_SESSION['itemQuantityError']) && $_SESSION['itemQuantityError']){?>
                        <span class="text-danger">Please fill the quantity</span><?php }?>
                </td>
            </tr>

        </table>

<div class="text-center">
    <input  type="submit" value="update" align="center" class="btn btn-primary" name="submit">

</div>
    </div>

</form>
</body>
</html>


<?php
if(isset($_POST['submit']))
{
    $new_desc= $_POST['new_description'];
    $new_quantity= $_POST['new_quantity'];
    $id=$_POST['id'];
    $_SESSION['newQuantity'] = $new_quantity;
    try
    {
        if($new_quantity == "") {
            if (isset($_POST['id'])) {

            $_SESSION['itemQuantityError'] = true;
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . "edit.php?id=$id" . '">';
        }
            exit();
        }
        if($object->update($id, $new_desc, $new_quantity)) {
            header('location: home.php');
        }
        else {
            echo "<script>alert('Error')</script>";
        }
    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }
}
session_destroy();

?>
