<?php
session_start();
require_once("../Classes/Order.php");
require_once("../Classes/Product.php");
include_once("../utilities/sanitizer.php");

// if metod is post
if ($_POST) {
    // sanitize as always
    $fullname = sanitize($_POST["fullname"]);
    $phone = sanitize($_POST["phone"]);
    $address = sanitize($_POST["address"]);
    $stateid = $_POST["stateid"];
    $lga = $_POST["lga"];
    $total = $_POST["finalamount"];
    $custid = sanitize($_POST["cust_id"]);
    // if empty, send back and kill script
    if (empty($fullname) || empty($phone) || empty($address) || empty($stateid) || empty($lga) || empty($total) || empty($custid)) {
        $_SESSION["feedback"] = "All fields are required";
        header("Location:../checkout.php");
        exit();
    }
    // if not, insert into database
    $order1 = new Order();
    $orderId = $order1->insert_order($total, $fullname, $custid, $phone, $address, $stateid, $lga);
    $lastorder_id = $order1->fetch_last_order($custid);

    if ($orderId) {
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $existingOrderItem = $order1->fetch_last_item($lastorder_id, $productId);

            if (is_array($existingOrderItem)) {
                $newQuantity = $existingOrderItem['order_quantity'] + $quantity;
                $order1->update_order_item_quantity($lastorder_id, $productId, $newQuantity);
            } else {
                $prod1 = new Product();
                $productDetails = $prod1->get_product_detail($productId);
                $subtotal = $productDetails['prod_amt'] * $quantity;
                $orderitem = $order1->insert_order_item($lastorder_id["order_id"], $productId, $quantity, $subtotal);

                if (!$orderitem) {
                    $_SESSION["feedback"] = "Failed to add order items";
                    header("Location:../checkout.php");
                    exit();
                }
            }
        }
        // collect email and other details in session and send to payment page
        if (isset($_SESSION["email"])) {
            $email = $_SESSION["email"];
            $_SESSION["order_id"] = $lastorder_id["order_id"];
            $_SESSION["totalamount"] = $total;
            header("Location:../paymentpage.php");
            exit();
        } else {
            $_SESSION["feedback"] = "Email not set in session";
            header("Location:../checkout.php");
            exit();
        }
    } else {
        $_SESSION["feedback"] = "Failed to place order";
        header("Location:../checkout.php");
        exit();
    }
} else {
    header("Location:../checkout.php");
    exit();
}
?>
