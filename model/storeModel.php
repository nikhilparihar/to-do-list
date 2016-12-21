<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 10:44
 */
include ('baseModel.php');
class storeModel extends baseModel
{
    public function __construct()
    {
        parent::__construct();
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
    public function fetchStoreName()
    {
        $sql="select store_name from store";
        $fetch=$this->execute_query($sql);
        return $fetch;
    }
    public function bought($id, $price, $store_id, $setdate)
    {
        $isQuery = false;
      // $setdate = date("Y-d-m");
       $bought_update = "update item set is_check = 1, price='$price', store_id='$store_id', create_at='$setdate' WHERE id =" . $id;
       // var_dump($bought_update);
        if ($this->execute_query($bought_update)) {
            $isQuery = true;
        }
        //var_dump(gettype($setdate));
        return $isQuery;
    }
    public function fetch_quantity($id)
    {
        $sql = "select quantity form item where id =" . $id;
        $fetch = $this->execute_query($sql);
        return $fetch;
    }
    public function getId($id)
    {
        return $id;
    }
    public function fetchForConfirm($id)
    {
        $query="select name from item where id=".$id;
        return $this->execute_query($query)->fetch();
    }
}