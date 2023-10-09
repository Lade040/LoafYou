<?php
error_reporting(E_ALL);
include_once("Db.php");

class Customer extends Db{

    public function fetch_customers(){
        $sql="SELECT * FROM customer";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $customer=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $customer;
    }
}

// $cust1= new Customer();
// $reply=$cust1->fetch_customers();
// echo "<pre>";
// print_r($reply);
// echo "</pre>";
?>