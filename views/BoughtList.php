<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 11-11-2016
 * Time: 14:11
 */
include ('../model/itemModel.php');
$obj=new itemModel();
$objects=$obj->bought_list();
$take=$obj->fetchBoughtItem();
?>

<html>
<head>
    <title>Complete list</title>
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
<div class="container fluid">
    <table class="table table-striped table-bordered">
        <?php if(count($take) > 0) {?>
        <tr>
            <td>
                Name of Product
            </td>
            <td>
                Description
            </td>
            <td>
                Quantity
            </td>
            <td>
                Price
            </td>
            <td>
                Name of store
            </td>
            <td>
                Create at
            </td>
        </tr>

        <?php foreach($objects as $object):?>
        <tr>
            <td><?php echo $object['name']?></td>
            <?php if($object['description']==null){?>
                <td>Not available</td>
            <?php } else {?>
            <td><?php echo $object['description']?></td>
            <?php }?>
            <td><?php echo $object['quantity']?></td>
            <td><?php echo $object['price']?></td>
            <td><?php echo $object['store_name']?></td>
            <td><?php echo $object['create_at']?></td>
        </tr>

        <?php endforeach; if(count($take) > 5){?>

            <tr>
                <td colspan="6">
                    <div class="text-center">
                        <?php $obj->pagination('BoughtList.php');?>
                    </div>
                </td>
            </tr>
            <?php }?>
        <?php } else { ?>

            <tr>
                <td>
                    <div class="text-center alert alert-danger">List is yet to be create</div>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
</body>
</html>