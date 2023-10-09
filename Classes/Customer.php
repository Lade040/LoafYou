<?php
error_reporting(E_ALL);
include_once("Db.php");

class Customer extends Db{

    public function register_customer($cust_firstname,$cust_lastname,$cust_phone,$cust_email,$cust_gender,$cust_dob,$cust_password,$cust_address,$cust_state,$cust_lga){

        // email validation to check if email already exists
        $sql="SELECT * FROM customer WHERE cust_email = ?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_email,PDO::PARAM_STR);
        $stmt->execute();
        $customer_count=$stmt->rowCount();
        if($customer_count > 0){
            return "error, email already exists";
            exit();
        }

        $sql="INSERT INTO customer(cust_firstname,cust_lastname,cust_phone,cust_email,cust_gender,cust_dob,cust_password,cust_address,cust_state,cust_lga) VALUES(?,?,?,?,?,?,?,?,?,?)";

        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_firstname,PDO::PARAM_STR);
        $stmt->bindParam(2,$cust_lastname,PDO::PARAM_STR);
        $stmt->bindParam(3,$cust_phone,PDO::PARAM_STR);
        $stmt->bindParam(4,$cust_email,PDO::PARAM_STR);
        $stmt->bindParam(5,$cust_gender,PDO::PARAM_STR);
        $stmt->bindParam(6,$cust_dob,PDO::PARAM_STR);
        $stmt->bindParam(7,$cust_password,PDO::PARAM_STR);
        $stmt->bindParam(8,$cust_address,PDO::PARAM_STR);
        $stmt->bindParam(9,$cust_state,PDO::PARAM_STR);
        $stmt->bindParam(10,$cust_lga,PDO::PARAM_STR);

        $result=$stmt->execute();
        return $result;

    }

    public function login_customer($cust_email,$cust_password){
        // validation to check if email exists
        $sql="SELECT * FROM customer WHERE cust_email =?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindparam(1, $cust_email, PDO::PARAM_STR);
        $stmt->execute();
        $customer_count=$stmt->rowCount();
        // if email is not in existence, rowCount will return 0
        if($customer_count < 1){
            return "Either email or password is incorrect";
            exit();
        }

        $customer=$stmt->fetch(PDO::FETCH_ASSOC);

        $password_match=password_verify($cust_password, $customer["cust_password"]);
        
        if($password_match){
            $_SESSION["cust_id"]=$customer["cust_id"];
            header("location:../index.php");
            exit();
        }

        // else an error message should be returned
        return "either email or password is incorrect";
    }

    public function fetch_details($user_id){
        $sql="SELECT * FROM customer WHERE cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $cust_details=$stmt->fetch(PDO::FETCH_ASSOC);
        return $cust_details;
    }

    public function update_customer_details($cust_firstname,$cust_lastname,$cust_phone,$cust_email,$cust_gender,$cust_dob,$cust_password,$cust_address,$cust_state,$cust_lga,$cust_id){
        $sql="UPDATE customer SET cust_firstname=?, cust_lastname=?,cust_phone=?,cust_email=?,cust_gender=?,cust_dob=?,cust_password=?,cust_address=?,cust_state=?,cust_lga=? WHERE cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_firstname,PDO::PARAM_STR);
        $stmt->bindParam(2,$cust_lastname,PDO::PARAM_STR);
        $stmt->bindParam(3,$cust_phone,PDO::PARAM_STR);
        $stmt->bindParam(4,$cust_email,PDO::PARAM_STR);
        $stmt->bindParam(5,$cust_gender,PDO::PARAM_STR);
        $stmt->bindParam(6,$cust_dob,PDO::PARAM_STR);
        $stmt->bindParam(7,$cust_password,PDO::PARAM_STR);
        $stmt->bindParam(8,$cust_address,PDO::PARAM_STR);
        $stmt->bindParam(9,$cust_state,PDO::PARAM_STR);
        $stmt->bindParam(10,$cust_lga,PDO::PARAM_STR);
        $stmt->bindParam(11,$cust_id,PDO::PARAM_INT);
        $update=$stmt->execute();
        return $update;
    }
}

// $cust1= new Customer();
// $reply=$cust1->register_customer("Bimpe", "Adenuga","09123456756", "bimpe@gmail.com","female","1990-01-05","bimpe12345","2a olayiwola street","Lagos","Alimosho");
// echo $reply;
?>