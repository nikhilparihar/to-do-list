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
$tempItemName = isset($_SESSION['itemName']) ? $_SESSION['itemName']:"";
$tempItemQuantity = isset($_SESSION['itemQuantity']) ? $_SESSION['itemQuantity']:"";
$tempItemDesc = isset($_SESSION['itemDesc']) ? $_SESSION['itemDesc']:"";
$tempStoreId = isset($_SESSION['storeIid']) ? $_SESSION['storeIid'] :"";

/**
 * Created by PhpStorm.
 * User: nikhil
 * Date: 10-11-2016
 * Time: 10:45
 */
include ('../model/itemModel.php');
$itemObj= new itemModel();
$home_product = $itemObj->fetch();
$trending_store = $itemObj->fetch_trending_store();
$fetch_rows=$itemObj->count_item();
$fetch_store=$itemObj->count_store();
$bought=$itemObj->bought();
$prices=$itemObj->fetch_price();
$store_name = $itemObj->store_name();
$id=$itemObj->itemId();

?>
<html>
<head>
    <title>HomePage</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/confirmModal.js"></script>
    <script type="text/javascript" src="../js/bought.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" style="font-size:35px ">To Do List</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php"><span class="btn btn-primary" >Home</a></span> </li>
			 <li><a href="Logout.php"><span class="btn btn-primary" >Logout</a></span> </li>
        </ul>
    </div>
</nav>

    <div class="container-fluid">
        <div class="col-lg-6">
           <table class="table table-striped table-bordered">
               <tr>
                   <td colspan="7">
                      <div class="text-center"><strong> List of product</strong></div>
                   </td>
               </tr>
            <?php if(count($fetch_rows) > 0) { ?>
               <tr>
                   <td>
                    Name of product
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
                    <td colspan="3">
                        <div class="text-center">
                           Actions
                         </div>
                    </td>
            </tr><form method="get">
                <?php foreach($home_product as $main):?>
            <tr>
                    <td>
                    <?php echo $main['name']?>
                    </td>
                   <?php if($main['description']== null){?>
                       <td>
                        <?php echo 'Not available'?>
                       </td>
                        <?php } else {?>
                        <td>
                        <?php echo $main['description']?>
                        </td>
                        <?php }?>
                        <td>
                        <?php echo $main['quantity']?>
                        </td>
                   <?php if($main['is_check']==0){?>
                        <td>
                        <?php echo '--'?>
                        </td>
                        <?php } else {?>
                        <td>
                            <?php echo $main['price']?>
                        </td>
                        <?php }?>
                   <?php if($main['is_check']==0){?>
                    <td>
                        <div class="text-center">
<!--                            <button type="button" name="bought" data-id="--><?php //echo $main['item_id'];?><!--"  data-name="--><?php //echo $main['name']?><!--" class="add_data btn btn-success btn-sm" data-target="#boughtModal">Bought</button>-->
                            <a href="Confirm.php?id=<?php echo $main['item_id']?>" type="submit" class="btn btn-success btn-sm" value="<?php echo $main['item_id']?>" name="confirm" >Bought</a>
                        </div>

                    </td>
                        <?php } else {?>
                    <td><div class="text-center text-info"><i class="glyphicon glyphicon-ok"></i></div></td>
                        <?php } if($main['is_check']==0){?>
                    <td>
                    <a href="Edit.php?id=<?php echo $main['item_id']?>" type="submit" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                        <?php } else {?>
                        <td>
                            Bought
                        </td>
                        <?php } if($main['is_check']==0){?>
                        <td>
                          <div class="text-center">
                            <button type="submit" onClick="return confirm('Are you sure','YES','No')" name="delete" class="btn btn-danger btn-sm" value="<?php echo $main['item_id']?>">Delete</button>
                          </div>
                        </td><?php } else {?>
                        <td>
                            Bought
                        </td>
                        <?php }?>
            </tr>
                <?php endforeach;?>
           <?php if(count($fetch_rows) > 5) {?>
                <tr>
                    <td colspan="7">
                        <div class="text-center">
                           <?php  $itemObj->pagination('home.php');?>
                        </div>
                    </td>
                </tr>
           <?php } ?>
            <tr>
                <td colspan="4" align="center">
                    <div class="text-center"><a href="" id="myBtn" class="btn btn-primary"><strong>Add more item</strong></a></div>
                </td>
                <td colspan="3" align="center">
                    <div class="text-center"><a href="BoughtList.php" class="btn btn-primary"><strong>See bought list</strong></a></div>
                </td>
            </tr>
            <?php } else {?>
                <tr>
                    <td>
                        <div class="text-center alert alert-danger">No Item list is available yet.Click <a href="item.php">here</a> to create a list</div>
                    </td>
                </tr>
            <?php }?>
        </table>
        </div>


        <div class="col-lg-5">
            <table class="table table-striped table-bordered">
                <tr >
                    <td colspan="2"><div class="text-center"><strong>Trending store</strong></div></td>
                </tr>
                <?php if(count($fetch_store) > 0) {?>
                <tr>
                    <td>
                        Store
                    </td>
                    <td>
                        Purchase(in RS)
                    </td>
                </tr>
                <?php foreach ($trending_store as $mains):?>
                <tr>
                    <td>
                        <?php echo $mains['name']?>
                    </td>

                    <td>
                        <?php echo $mains['price']?>
                    </td>
                        <?php endforeach;?>
                </tr>

    <?php } else {?>
                    <tr>
                        <td>
                            <div class="text-center alert alert-danger">Trend is yet to be set</div>
                        </td>
                    </tr>
    <?php }?>
            </table>
        </div>
    </div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="register_alert">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3>Add item in list</h3>
                <p>(<span class="text-danger">* Required fields</span>)</p>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger hide"></div>
                <form method="post" id="formAddItem">
                    <table class="table">
                        <tr>
                            <td>
                                Name of item:<span class="text-danger">*</span>
                            </td>
                            <td>
                                <input type="text" name="product_name" id="product_name" placeholder="Name of product" class="form-control" value="<?php echo $tempItemName ?>" >
                                <?php if(isset($_SESSION['itemNameError']) && $_SESSION['itemNameError']){ ?>
                                    <span class="text-danger">PLease fill the item name</span> <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Description(optional)
                            </td>
                            <td>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Quantity:<span class="text-danger">*</span>
                            </td>
                            <td>
                                <input type="text" name="quantity" id="quantity"class="form-control" value="<?php echo $tempItemQuantity?>"<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : '' ?>" placeholder="Enter quantity">
								<?php if(isset($_SESSION['itemQuantityError']) && $_SESSION['itemQuantityError']){?>
                                    <span class="text-danger">Please fill the quantity</span><?php }?>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <input type="submit" id="submitForm" value="Submit" class="btn btn-primary">
                    </div>
                    </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="boughtModal" data-id="" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
<!--                <h1 class="hide"><input type="hidden" name="id" value="--><?php //if(isset($_POST['data_id'])){echo $_POST['data_id'];}?><!--"></h1>-->
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 name="name" id="name"></h4>
<!--                <h4>--><?php //$productName = $itemObj->fetchForConfirm('$')?><!--Product:--><?php //echo $productName['name']?><!--</h4>-->
            </div>
            <div class="modal-body">
              <div class="alert alert-danger hide"></div>
                <table class="table">
                            <tr>
                                <td>
                                    Store:
                                </td>
                                <td>
                                    <select name="store" id="store">
                                        <option value="-1">--Select store--</option>
                                        <?php
                                        foreach ($store_name['isQuery'] as $name):?>
                                            <option  value=<?php echo $name['id']?>>
                                                <?php
                                                echo $name['store_name']//name =store[name]
                                                ?>
                                            </option>
                                        <?php  endforeach;
                                        ?>
                                    </select>
                                    didn't find your store <a href="" class="storelink">Add store</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Price:
                                </td>
                                <td>
                                    <input type="number" id="price" name="price" placeholder="Enter price">
                                </td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <input type="button" id="submit" name="submit" value="submit" class="btn btn-primary">
                        </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_GET['delete'])) {
    if ($itemObj->delete($_GET['delete'])) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . "home.php" . '">';
    }
}
?>