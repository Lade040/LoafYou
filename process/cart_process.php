<?php 
session_start();
error_reporting(E_ALL);
include_once("../utilities/sanitizer.php");
require_once("../Classes/Product.php");
require_once("../Classes/Cart.php");
// if request method is post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["productid"]) && isset($_POST["quantity"])) {
        // sanitize all inputs for security
        $productId = sanitize($_POST["productid"]); 
        $quantity = sanitize($_POST["quantity"]); 
        
        if (is_numeric($productId) && is_numeric($quantity) && intval($quantity) > 0) {
            // if product alread exists in cart,increase quantity on addition
            if (isset($_SESSION["cart"][$productId])) {
                $_SESSION["cart"][$productId] += intval($quantity);
                // if not,add it 
            } else {
                $_SESSION["cart"][$productId] = intval($quantity);
            }
            // if cart is in session count cart
            if(isset($_SESSION["cart"])){
                $cartcount=count($_SESSION["cart"]);
                // if not cart count=0
            }else{
                $cartcount=0;
            }
            // send response to ajax front end
            $response = array("status" => "success", "message" => "Product added to cart successfully","cartcount"=>$cartcount);
            echo json_encode($response);
            
        } else {
            $response = array("status" => "error", "message" => "Invalid product ID or quantity");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => "Product ID or quantity not provided");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}

?>