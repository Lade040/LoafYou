<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Product extends Db{

    public function insert_product($prod_name,$prod_desc,$prod_img,$prod_img2,$prod_amt,$prodcategory_id){
        $sql="SELECT * FROM product WHERE prod_name=?";

        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_name,PDO::PARAM_STR);
        $stmt->execute();
        $product_count=$stmt->rowCount();
        if($product_count > 0){
            header("location:../product.php");
            return "Product already exists";
            exit();
        }

        $sql="INSERT INTO product(prod_name,prod_desc,prod_img,prod_img2,prod_amt,prodcategory_id) VALUES(?,?,?,?,?,?)";

        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_name,PDO::PARAM_STR);
        $stmt->bindParam(2,$prod_desc,PDO::PARAM_STR);
        $stmt->bindParam(3,$prod_img,PDO::PARAM_STR);
        $stmt->bindParam(4,$prod_img2,PDO::PARAM_STR);
        $stmt->bindParam(5,$prod_amt,PDO::PARAM_INT);
        $stmt->bindParam(6,$prodcategory_id,PDO::PARAM_INT);
        $result=$stmt->execute();
        return $result;

    }

    public function fetch_all_product(){
        $sql="SELECT * FROM product";
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
    public function edit_product($prod_name,$prod_desc,$prod_img_path,$prod_img2_path,$prod_amt,$prod_category,$prod_id){
        $sql="UPDATE product SET prod_name=?,prod_desc=?,prod_img=?,prod_img2=?,prod_amt=?,prodcategory_id=? WHERE prod_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_name, PDO::PARAM_STR);
        $stmt->bindParam(2,$prod_desc, PDO::PARAM_STR);
        $stmt->bindParam(3,$prod_img_path, PDO::PARAM_STR);
        $stmt->bindParam(4,$prod_img2_path, PDO::PARAM_STR);
        $stmt->bindParam(5,$prod_amt, PDO::PARAM_INT);
        $stmt->bindParam(6,$prod_category, PDO::PARAM_INT);
        $stmt->bindParam(7,$prod_id, PDO::PARAM_INT);
        $edit=$stmt->execute();
        return $edit;
    }

    public function delete_product($prod_id){
        $sql="DELETE FROM product WHERE prod_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$prod_id,PDO::PARAM_INT);
        $deleted=$stmt->execute();
        return $deleted;
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
// $product=$pro1->search_product("cake");
// echo "<pre>";
// print_r($product);
// echo "</pre>";

?>