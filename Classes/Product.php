<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Product extends Db{

    public function fetch_all_product(){
        $sql="SELECT * FROM product ";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $product=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    public function fetch_random_product(){
        $sql="SELECT * FROM product ORDER BY RAND() LIMIT 4";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $product=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    public function get_product_detail($product_id){
        $sql="SELECT * FROM product WHERE prod_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$product_id, PDO::PARAM_INT);
        $stmt->execute();
        $detail=$stmt->fetch(PDO::FETCH_ASSOC);
        return $detail;
    }


    public function fetch_product_by_category($prodcategory_id){
        $sql="SELECT * FROM product WHERE prodcategory_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prodcategory_id,PDO::PARAM_INT);
        $stmt->execute();
        $product=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    public function search_product($product_name){
        $sql="SELECT * FROM product WHERE prod_name LIKE ?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(["%$product_name%"]);
        $count=$stmt->rowCount();
        if($count > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "No product match found";
        }
        
    }
}
// $pro1= new Product();
// $product=$pro1->search_product("bread");
// print_r($product);
?>