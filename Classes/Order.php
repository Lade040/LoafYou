<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Order extends Db{
    public function insert_order($order_total,$order_name,$cust_id,$order_phone,$order_address,$order_state,$order_lga){
        $sql="INSERT INTO `order`(order_total,order_name,cust_id,order_phone,order_address,order_stateid,order_lga)VALUES(?,?,?,?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$order_total,PDO::PARAM_INT);
        $stmt->bindParam(2,$order_name,PDO::PARAM_STR);
        $stmt->bindParam(3,$cust_id,PDO::PARAM_INT);
        $stmt->bindParam(4,$order_phone,PDO::PARAM_STR);
        $stmt->bindParam(5,$order_address,PDO::PARAM_STR);
        $stmt->bindParam(6,$order_state,PDO::PARAM_INT);
        $stmt->bindParam(7,$order_lga,PDO::PARAM_STR);
        $order=$stmt->execute();
        return $order;
        
    }

    public function fetch_last_order($cust_id){
        $sql="SELECT * FROM `order`WHERE cust_id=? ORDER BY order_id DESC LIMIT 1";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_id,PDO::PARAM_INT);
        $stmt->execute([$cust_id]);
        $lastorderid=$stmt->fetch(PDO::FETCH_ASSOC);
        return $lastorderid;

    }

    public function fetch_last_item($order_id,$prod_id){
        $sql="SELECT * FROM `order_item` WHERE `order_id`=? AND product_id=? ";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute([$order_id,$prod_id]);
        $last_item=$stmt->fetch(PDO::FETCH_ASSOC);
        return $last_item;
    }

    public function update_order_item_quantity($order_id, $product_id, $new_quantity) {
        $sql = "UPDATE `order_item` SET `quantity` = ? WHERE `order_id` = ? AND `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $update=$stmt->execute([$new_quantity, $order_id, $product_id]);
        return $update;
    }

    public function fetch_order($cust_id){
           
        $sql= "SELECT * FROM `order_item` JOIN `order` ON `order_item`.order_id = `order`.order_id JOIN product ON `order_item`.product_id = product.prod_id WHERE cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1, $cust_id,PDO::PARAM_INT);
        $stmt->execute();
        $orders= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    public function fetch_product($product_id){
        $sql="SELECT prod_name FROM product JOIN order_item ON prod_id=product_id WHERE prod_id = :product_id";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(":product_id",$product_id,PDO::PARAM_INT);
        $stmt->execute();
        $allprod=$stmt->fetch(PDO::FETCH_ASSOC);
        if($allprod){
            return $allprod;
        }else{
            return false;
        }
        

    }
    	
    
    public function insert_order_item($order_id,$product_id,$order_quantity,$order_subtotal){
        $sql="INSERT INTO order_item(order_id,product_id,order_quantity,order_subtotal)VALUES(?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$order_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$product_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$order_quantity,PDO::PARAM_INT);
        $stmt->bindParam(4,$order_subtotal,PDO::PARAM_INT);
        $item=$stmt->execute();
        return $item;
    }
    
}

// $cat1= new Order();
// $category=$cat1->fetch_order(7);
//  print_r($category);
// if ($category) {
//     $lastInsertId = $category; // Use the returned order ID directly
//     $mysqli = new mysqli("localhost", "root", "", "loafyou");
//     // If you still want to use mysqli_insert_id, use it like this:
//     $lastInsertId = mysqli_insert_id($mysqli);
//     echo $lastInsertId;
// }
?>