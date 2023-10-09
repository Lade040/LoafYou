<?php 
session_start();
require_once("../Classes/Review.php");
include_once("../utilities/sanitizer.php");
if($_POST){
    $cust_id=sanitize($_POST["cust_id"]);
    $rev_id=sanitize($_POST["rev_id"]);
    $prod_id=sanitize($_POST["prod_id"]);
    $rev1=new Review();
    $review=$rev1->delete_review($rev_id,$cust_id);
    if($review){
        $_SESSION["feedback"] = "Review deleted successfully";
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
        error_log("Error occurred during review deletion.");
    }
    
    header("location:../product.php?id=$prod_id");
    
}

?>