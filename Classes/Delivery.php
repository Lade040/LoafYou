<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Delivery extends Db{

    public function fetch_delivery(){
       $sql="SELECT * FROM shipping";
       $stmt=$this->connect()->prepare($sql);
       $stmt->execute();
       $delivery=$stmt->fetchAll(PDO::FETCH_NUM);
       return $delivery;

    }

   
    
}

// $cart1= new Delivery();
// $cartitem=$cart1->fetch_delivery();
// print_r($cartitem);
?>