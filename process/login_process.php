<?php
session_start();
error_reporting(E_ALL);
include_once("../utilities/sanitizer.php");
include_once("../Classes/Customer.php");
if($_POST){
    // if login button is clicked collect email and password,sanitize
    if(isset($_POST["login_btn"])){
        $cust_email=sanitize($_POST["cust_email"]);
        $cust_password=sanitize_pass($_POST["cust_password"]);
    // if empty send error message back to frontend and kill script
        if(empty($cust_email) || empty($cust_password)){
            $_SESSION["login_error"]="All fields are required";
            header("location:../login.php");
            exit();
        }
    // confirm details in database
        $cust1= new Customer();
        $response=$cust1->login_customer($cust_email,$cust_password);

        if($response){
            $_SESSION["login_error"]="Either email or password is incorrect";
            header("location:../login.php");
            exit();
        }
        // if login is successful send use to profile page
        header("location:userprofile.php");
    }
}else{
    header("location:../login.php");
}
?>