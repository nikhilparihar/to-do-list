<?php
/**
 * Created by PhpStorm.
 * User: nikhi
 * Date: 10-11-2016
 * Time: 12:03
 */
include ('../app/dbConnector.php');
class baseModel extends dbConnector {
    protected $connectDb;

    public function __construct()
    {
        $this->connectDb = $this->connect();
    }
public function insert($tabelName, $data)
{
    $isQuery = false;
    $array_keys = array_keys($data);
    $array_values = array_values($data);
    $values =[];
    foreach( $array_values as $key ) {
        if( !in_array($key, $values) ) {
            $values[] = "'" . mysql_real_escape_string($key) . "'";
        }
    }
    $val=implode(",",$values);
    $key=implode(",",$array_keys);

    $query = 'insert into '.$tabelName.' ('.$key.') VALUES ('.$val.')';

   // var_dump($val);
    //var_dump($query);

    if($this->execute_query($query))
    {
        $isQuery = true;
    }
    return $isQuery;
}
}