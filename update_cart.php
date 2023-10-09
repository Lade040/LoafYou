<?php
session_start();
// lines of code to update product quantity inside cart
if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $newQuantity = intval($_POST['quantity']);

    // Check if the product is in the cart
    if (isset($_SESSION['cart'][$productId])) {
        // Update the quantity
        $_SESSION['cart'][$productId] = $newQuantity;
        echo json_encode(array("status" => "success", "message" => "Quantity updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Product not found in the cart"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
?>
