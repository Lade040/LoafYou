<?php
session_start();
error_reporting(E_ALL);
include_once("../Classes/Product.php");
if($_POST){
    if(isset($_POST["delbtn"])){
        $prod_id=$_POST["prod_id"];

        $prod1= new Product();
        $deleted=$prod1->delete_product($prod_id);
        if($deleted){
           $_SESSION["feedback"]="Product deleted successfully";
           header("location:../product.php");
        }else{
            $_SESSION["feedback"]="An error occured while trying to delete this product";
            header("location:../product.php"); 
        }


    }
}else{
    header("location:../product.php");
}

?>