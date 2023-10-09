<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Review extends Db{

    public function insert_review($prod_id,$cust_id,$rev_text,$ratings){
        $sql = "SELECT COUNT(*) FROM order_item WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $prod_id, PDO::PARAM_INT);
        $stmt->execute();
        $purchaseCount = $stmt->fetchColumn();

        if ($purchaseCount < 1) {
            $_SESSION["feedback"] = "You can only leave a review if you've purchased this product";
            header("location: ../review");
            exit();
        }

        $sql="INSERT INTO review(prod_id,cust_id,rev_text,ratings) VALUES(?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$cust_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$rev_text,PDO::PARAM_STR);
        $stmt->bindParam(4,$ratings,PDO::PARAM_INT);
        try {
            $stmt->execute();
            // Success, you can handle the success case if needed
            return true;
        } catch (PDOException $e) {
            // Handle the error
            error_log("Error: " . $e->getMessage()); // Log the error message to error log
            return false; // Return false to indicate failure
        }
        
  
    }
    

    public function edit_review($prod_id,$cust_id,$rev_text,$ratings){
        $sql = "SELECT COUNT(*) FROM review WHERE rev_id = ? AND cust_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $reviewCount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reviewCount === 0) {
            $_SESSION["error"]="You can only edit reviews you wrote";
            header("location:../product");
            return false;
        }

        $sql="UPDATE review SET prod_id=?,cust_id=?,rev_text=?,ratings=?";
        $stmt=$this->connect()->prepare($sql);

        $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$cust_id,PDO::PARAM_INT);
        $stmt->bindParam(3,$rev_text,PDO::PARAM_STR);
        $stmt->bindParam(4,$ratings,PDO::PARAM_INT);

        
        $edited=$stmt->execute();
        return $edited;
    }

    public function fetch_review($prod_id){
        $sql="SELECT * FROM review WHERE prod_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
        $stmt->execute();
        $prodreviews=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $prodreviews;
    }

    public function fetch_reviewer($cust_id){
        $sql="SELECT customer.cust_firstname, customer.cust_lastname FROM customer 
        JOIN review ON customer.cust_id = review.cust_id WHERE review.cust_id = :cust_id";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(":cust_id",$cust_id,PDO::PARAM_INT);
        $stmt->execute();
        $reviewer=$stmt->fetch(PDO::FETCH_ASSOC);
        return $reviewer;
        
    }
    public function delete_review($rev_id,$cust_id){

        $sql="DELETE FROM review WHERE rev_id=? AND cust_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$rev_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$cust_id,PDO::PARAM_INT);
        $deleted=$stmt->execute();
        return $deleted;
        
    }

    public function average_review($prod_id){
        $sql="SELECT AVG(ratings) AS average_rating FROM review WHERE prod_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
        $stmt->execute();
        $average=$stmt->fetch(PDO::FETCH_ASSOC);
        return $average;
    }
    
}
// $rev1=new Review();
// $review=$rev1->delete_review(3,7);

?>