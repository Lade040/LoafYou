<?php
error_reporting(E_ALL);
include_once("Db.php");

class Admin extends Db{

    public function register_admin($admin_email,$admin_pass){
        // email validation to check if email already exists
        $sql="SELECT * FROM admin WHERE admin_email = ?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$admin_email,PDO::PARAM_STR);
        $stmt->execute();
        $admin_count=$stmt->rowCount();
        if($admin_count > 0){
            header("location:../register.php");
            return "error, email already exists";
            exit();
        }

        $sql="INSERT INTO admin(admin_email,admin_pass) VALUES(?,?)";

        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$admin_email,PDO::PARAM_STR);
        $stmt->bindParam(2,$admin_pass,PDO::PARAM_STR);

        $result=$stmt->execute();
        return $result;
        header("location:..profile.php");
    }

    public function login_admin($admin_email, $admin_pass){
         // validation to check if email exists
         $sql="SELECT * FROM admin WHERE admin_email =?";
         $stmt=$this->connect()->prepare($sql);
         $stmt->bindparam(1, $admin_email, PDO::PARAM_STR);
         $stmt->execute();
         $admin_count=$stmt->rowCount();
         // if email is not in existence, rowCount will return 0
         if($admin_count < 1){
             return "Either email or password is incorrect";
             exit();
         }
 
         $admin=$stmt->fetch(PDO::FETCH_ASSOC);
 
         $password_match=password_verify($admin_pass, $admin["admin_pass"]);
         
         if($password_match){
             $_SESSION["admin_id"]=$admin["admin_id"];
             header("location:../profile.php");
             exit();
         }
 
         // else an error message should be returned
         return "either email or password is incorrect";
    }

    public function fetch_details(){
        $sql="SELECT * FROM customer";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $customer=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $customer;
    }

    public function fetch_all_orders(){
        $sql = "SELECT * FROM `order` 
                JOIN `state` ON `order`.order_stateid = `state`.state_id
                JOIN payment on payment.order_id =`order`.order_id WHERE pay_status='success'";
    
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }

    public function fetch_all_order_details(){
        $sql = "SELECT * FROM `order_item`";
    
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
    public function fetch_order_item(){
        $sql="SELECT * FROM `order` 
        JOIN payment on payment.order_id =`order`.order_id
        JOIN `order_item` ON order_item.order_id =`order`.order_id
        JOIN product ON product.prod_id=order_item.product_id
        JOIN customer ON customer.cust_id=`order`.cust_id
        WHERE pay_status='success'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $item;
    }

    public function fetch_payment(){
        $sql = "SELECT * FROM `payment` WHERE pay_status='success' ";
    
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
}

// $admin1= new Admin();
// $reply=$admin1->fetch_order_item();
// print_r($reply);
?>