<?php 
session_start();
error_reporting(E_ALL);
include("../Classes/Review.php");
include_once("../utilities/sanitizer.php");

if($_POST){
    // validation and sanitization for reviews
    if(isset($_POST["rev_btn"])){
        $prod_id=sanitize($_POST["prod_id"]);
        $cust_id=sanitize($_POST["cust_id"]);
        $rev_text=sanitize($_POST["rev_text"]);
        $ratings=sanitize($_POST["ratings"]);
        
        // validation
        if(empty($prod_id) || empty($cust_id) || empty($rev_text) || empty($ratings)){
            $_SESSION["feedback"]="All fields are required";
            header("location:../review.php?id=$prod_id");
           exit();
        }

        // store review n the database
        $rev1= new Review();
        $reviewed=$rev1->insert_review($prod_id,$cust_id,$rev_text,$ratings);
        if($reviewed){
            $_SESSION["feedback"]="Thank you for taking out time to write your review!";
            header("location:../product.php?id=$prod_id");
        }

      
    
    }
}else{
    header("location:../index.php");
}
?>