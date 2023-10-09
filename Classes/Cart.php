<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Cart extends Db{

    public function insert_cart($prod_id,$prod_qt,$cust_id){
       $sql="INSERT INTO cart(prod_id, prod_qt,cust_id)VALUES(?,?,?)";
       $stmt=$this->connect()->prepare($sql);
       $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
       $stmt->bindParam(2,$prod_qt,PDO::PARAM_INT);
       $stmt->bindParam(3,$cust_id,PDO::PARAM_INT);
       $cart=$stmt->execute();
       return $cart;

    }

   
    
}

// $cart1= new Cart();
// $cartitem=$cart1->insert_cart(4,1,2);
// echo $cartitem;
?>