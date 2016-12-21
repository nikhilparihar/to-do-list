<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 10:44
 */
include ('baseModel.php');
class itemModel extends baseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetch($perPage=5)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $upperLimit = $perPage;
        if (empty($page) || $page == 1) {
            $lowerLimit = 0;
        } else {
            $lowerLimit = ($page * $perPage) - $perPage;
        }

        $fetch = "select * ,id as item_id from item LIMIT $lowerLimit,$upperLimit";
        return $isQuery = $this->execute_query($fetch);
    }

    public function count_item()
    {
        $fetch_num_of_items = "select * from item";
        $isQuery = $this->execute_query($fetch_num_of_items);
        $num_of_rows = $isQuery->fetchAll();
        return $num_of_rows;
    }

    public function count_store()
    {
        $fetch_num_of_store= "select *,(select store_name from store where item.store_id=store.id) as name from item where is_check=1";
        $isQuery=$this->execute_query($fetch_num_of_store);
        $num_of_store =$isQuery->fetchAll();
        return $num_of_store;
    }

    public function bought()
    {
        $sql="select is_check as bought from item";
        $isQuery=$this->execute_query($sql);
        return $isQuery;
    }
    public function fetch_trending_store()
    {
        //$isQuery=false;
        $fetch="select store_name, SUM(price) as price from store where is_check=1";
        $sql="select *,(select store_name from store where item.store_id=store.id) as name, SUM(price) as price from item where is_check=1 group by store_id order by price desc limit 0,3";

        return $isQuery=$this->execute_query($sql);
    }
    public function pagination($direct,$perPage = 5)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        // calculate the total number of pages for render
        $all = "select * from item";
        $totalRows = $this->execute_query($all)->fetchAll();
        $num_of_rows=count($totalRows);
        $num= $num_of_rows/$perPage;
        $num=ceil($num);
        ?>

        <ul class="pagination">
            <?php for ($b = 1; $b <= $num; $b++) {
                ?>
                <li class="<?php if (($page && $page == $b) || (!$page && $b == 1)) echo "active" ?>"><a
                        href= "<?php echo $direct; ?>?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
                <?php
            }?>
        </ul>
        <?php
    }

    public function fetch_price()
    {
        $fetch_price="select sum(price) as price from item WHERE is_check = 1";
        $sql=$this->execute_query($fetch_price);
        return $sql;
    }

    public function bought_list($perPage=5)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $upperLimit = $perPage;
        if (empty($page) || $page == 1) {
            $lowerLimit = 0;
        } else {
            $lowerLimit = ($page * $perPage) - $perPage;
        }
        $fetch="select *, (select store_name from store where item.store_id=store.id) as store_name from item where is_check=1 LIMIT $lowerLimit,$upperLimit";
        $sql=$this->execute_query($fetch);
        return $sql;
    }
    public function fetchBoughtItem()
    {

        $sql="select * from item where is_check=1";
        $fetch =$this->execute_query($sql);
        return $take=$fetch->fetchAll();
    }
    public function edit($id)
    {
        $sql="select * from item where id=".$id;
        $fetch=$this->execute_query($sql);
        $fetchall=$fetch->fetchAll();
        return $fetchall;
    }
    public function update($id, $desc, $quantity)
    {
        $isQuery=false;
        $sql="update item set description='$desc', quantity='$quantity' WHERE  id=".$id;
        if($this->execute_query($sql))
        {
            $isQuery=true;
        }
        return $isQuery;

    }

    public function FetchForEdit($id)
    {
        $query="select description,name,quantity from item where id=".$id;
    return $this->execute_query($query)->fetch();

    }

    public function delete($id)
    {
        $isQuery=false;
        $query="delete from item where id=".$id;
        if($this->execute_query($query))
        {
            $isQuery=true;
        }
        return $isQuery;
    }
    public function boughtModal($id, $price, $store_id)
    {
        $isQuery = false;
        // $setdate = date("Y-d-m");
        $bought_update = "update item set is_check = 1, price='$price', store_id='$store_id' WHERE id =" . $id;
        // var_dump($bought_update);
        if ($this->execute_query($bought_update)) {
            $isQuery = true;
        }
        //var_dump(gettype($setdate));
        return $isQuery;
    }
    public function store_name()
    {
        $fetch_store_name = "select store_name,id from store";
        $isQuery = $this->execute_query($fetch_store_name);
        $fetch = count($isQuery);

        $array = ['isQuery' => $isQuery,
            'fetch' => $fetch];
        return $array;
    }
    public function itemId()
    {
        $query="select id from item";
        $exe=$this->execute_query($query);
        return $exe;
    }
    }
?>