<?php
session_start();
// code to handle productt being deleted from cart
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Check if the product is in the cart
    if (isset($_SESSION['cart'][$productId])) {
        // Remove the product from the cart
        unset($_SESSION['cart'][$productId]);
        echo json_encode(array("status" => "success", "message" => "Product removed from cart successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Product not found in the cart"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
?>
