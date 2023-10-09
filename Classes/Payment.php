<?php 
error_reporting(E_ALL);
require_once("Db.php");

class Payment extends Db{

    public function insert_payment($pay_refcode,$pay_amount,$order_id,$pay_status,$pay_data,$pay_time){
        $sql="INSERT INTO payment(pay_refcode,pay_amount,order_id,pay_status,pay_data,pay_time)VALUES(?,?,?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$pay_refcode,PDO::PARAM_STR);
        $stmt->bindParam(2,$pay_amount,PDO::PARAM_INT);
        $stmt->bindParam(3,$order_id,PDO::PARAM_INT);
        $stmt->bindParam(4,$pay_status,PDO::PARAM_STR);
        $stmt->bindParam(5,$pay_data,PDO::PARAM_STR);
        $stmt->bindParam(6,$pay_time,PDO::PARAM_STR);

        $payment=$stmt->execute();
        if($payment){
            return true;
        } else {
            error_log("Payment insertion failed: ");
            return false;
        }
        
    }

    public function fetch_payment(){
        $sql="SELECT * FROM payment";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $allpayment=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $allpayment;

    }

    public function fetch_cust_payment($cust_id){
        $sql="SELECT * FROM payment WHERE cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cust_id,PDO::PARAM_INT);
        $stmt->execute();
        $allpayment=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $allpayment;
    }
}
// $pay1= new Payment();
// $payment= $pay1->insert_payment("response->reference","52500",24,"response->status","f_response","response->paid_at");
?>