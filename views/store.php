<?php
session_start();
$tempStoreName = isset($_SESSION['storeName']) ? $_SESSION['storeName']:"";
$tempStoreAddr = isset($_SESSION['storeAddr']) ? $_SESSION['storeAddr']:"";
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 10:45
 *
 */
include ('../model/storeModel.php');
//include  ('confirm.php');
$storeModel = new storeModel();
?>
<html>
<head>
    <title>StorePage</title>

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

<form method="post" action="store.php">
    <div class="container-fluid col-lg-9 col-xs-offset-2">
        <table class="table table-striped table-bordered">
            <tr>
                <td>
                    Name of store:
                </td>
                <td>
                    <input type="text" name="store_name" placeholder="Name of store" value="<?php echo $tempStoreName?>" >
                    <?php if(isset($_SESSION['storeError']) && $_SESSION['storeError']){?>
                        <span class="text-danger">Please fill the name</span><?php }?>
                </td>
                <td class="hide"><input type="hidden" name="key" value="<?php if(isset($_GET['key'])){ echo $_GET['key']; }?>"></td>

                <td class="hide"><input type="hidden" name="redirectUrl" value="<?php if(isset($_GET['redirect'])){ echo $_GET['redirect']; }?>"></td>
            </tr>
            <tr>
                <td>
                    Address(optional):
                </td>
                <td>
                    <textarea name="address"><?php echo $tempStoreAddr?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text-center">
                        <a href="confirm.php?id=<?php echo $_GET['key']?>" class="btn btn-primary">Back</a>
                    </div>
                </td>
                <td>
                    <div class="text-center">
                        <input  type="submit" align="center" class="btn btn-primary" name="submit">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $store_name = $_POST['store_name'];
    //$store_id = $_POST['store'];
    $store_address = $_POST['address'];
    $_SESSION['storeAddr'] = $store_address;
    $_SESSION['storeName'] = $store_name;
    $key = $_POST['key'];
    try {
        // $item_insert_query="INSERT INTO item (name, description, quantity) VALUES ('$item_name','$item_desc','$item_quantity')";
        $table = 'store';
        $data = [
            "store_name" => $store_name,
            "store_addr" => $store_address
        ];
        if ($store_name == "")
        {
           if(isset($_POST['redirectUrl']))
           {
              $_SESSION['storeError'] =true;
               // echo "<script>alert('Name field must be fill')</script>";
               echo "<script>window.location.href = 'store.php?redirect=addItem&key=$key'</script>";
           }
            exit();
        }
        // $sql=$itemModal->insert($table, $data);
        if ($storeModel->insert($table, $data))
        {
            echo "<script>alert('store added')</script>";
           // header("location:home.php");
            //session_start();
           // require_once ('confirm.php');
            if ($_POST['redirectUrl'])
            {
                header("location:home.php?modal_id=" .$_POST['key']);
                //session_destroy();
            }
        else
            {
                header("location:home.php");
            }
        }
        else
        {
            echo "<script>alert('store is not added')</script>";
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
}
session_destroy();
?>
