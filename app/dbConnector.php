<?php
/**
 * Created by PhpStorm.
 * User: nikhil
 * Date: 10-11-2016
 * Time: 10:58
 */
class dbConnector
{
    public $hostname="localhost";
    public $username="root";
    public $password="";

    public $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
       return $this->connection = new PDO("mysql:host=$this->hostname; dbname=to_do_list", $this->username, $this->password);
    }

    public function execute_query($sql)
    {
        return $this->connection->query($sql);
    }

}