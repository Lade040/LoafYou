<?php 
error_reporting(E_ALL);
include_once("Db.php");

class Category extends Db{

    public function fetch_category(){
            // sql statement *SELECT * FROM category
        $sql= "SELECT * FROM category";
        // prepare statement
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();

        $category= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $category;
     
    }

    public function fetch_category_detail($cat_id){
        $sql="SELECT * FROM category WHERE category_id=?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$cat_id,PDO::PARAM_INT);
        $stmt->execute();
        $category_count=$stmt->rowCount();
        if($category_count < 1){
            return false;
            exit();
        }else{
            $category=$stmt->fetch(PDO::FETCH_ASSOC);
            return $category;
        }
        
    }
    
}

// $cat1= new Category();
// $category=$cat1->add_category("Bread");
// echo $category;
?>