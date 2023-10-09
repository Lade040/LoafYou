<?php
error_reporting(E_ALL);
include_once("config.php");

class Db{
    private $dbhost=DBHOST;
    private $dbuser=DUSER;
    private $dbname=DBNAME;
    private $dbpass=DBPASS;

    protected $conn;
    protected function connect(){
        $dsn="mysql:host=$this->dbhost;dbname=$this->dbname";

        $options=[
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->conn=new PDO($dsn, $this->dbuser, $this->dbpass, $options);

        }catch(Exception $e){
            return $e->getMessage();
        }
        return $this->conn;

    }

}

// $connection =new Db();
// var_dump($connection->connect());
?>