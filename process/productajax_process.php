<?php 
error_reporting(E_ALL);
require_once("../Classes/Product.php");
if($_POST){
    // ajax to organize product in categories
    if(isset($_POST["category"])){
        // if category is all fetch all product in database
        $cat_id=$_POST["category"];
        if ($cat_id === "all") {
            
            $prod1 = new Product();
            $allproduct = $prod1->fetch_all_product();
            echo json_encode($allproduct);
            // else fetch product based on category in database
        }else{
            $pro1=new Product();
            $products=$pro1->fetch_product_by_category($cat_id);
            // print_r($products);
            if($products){
                echo json_encode($products);
            }else{
                echo json_encode([]);
            }
        }
    }
}
?>

   