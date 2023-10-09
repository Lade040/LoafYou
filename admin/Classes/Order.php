<?php
error_reporting(E_ALL);
include_once("Db.php");
 class Order extends Db{

    public function insert_order($order_amt,$orderpay_method,$cust_id){
        $sql="INSERT INTO `order`(order_amt,orderpay_method,cust_id) VALUES(?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$order_amt,PDO::PARAM_INT);
        $stmt->bindParam(2,$orderpay_method,PDO::PARAM_STR);
        $stmt->bindParam(3,$cust_id,PDO::PARAM_INT);
        $order=$stmt->execute();
        return $order;
    }

    public function fetch_order_details($cust_id){
        $sql="SELECT * FROM order WHERE cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_id,PDO::PARAM_INT);
        $stmt->execute();
        $details=$stmt->fetch(PDO::FETCH_ASSOC);
        return $details;

    }

    
 }

//  $order1= new Order();
//  $order=$order1->insert_order(15000,"Paystack",2);
//  echo $order;
?>