<?php 
session_start();
error_reporting(E_ALL);
include("../Classes/Customer.php");
include_once("../utilities/sanitizer.php");
// var_dump($_SESSION["reg_error"]);

if($_POST){
    // if post and rigister button is clicked
    if(isset($_POST["reg_btn"])){
        $cust_firstname=sanitize($_POST["cust_firstname"]);
        $cust_lastname=sanitize($_POST["cust_lastname"]);
        $cust_phone=sanitize($_POST["cust_phone"]);
        $cust_email=sanitize($_POST["cust_email"]);
        $cust_dob=$_POST["cust_dob"];
        // $cust_dob=time("Y-m-d");
        $cust_password=sanitize_pass($_POST["cust_password"]);
        $confirm_password=sanitize_pass($_POST["confirmpassword"]);
        $cust_address=sanitize($_POST["cust_address"]);
        $cust_state=$_POST["cust_state"];
        $cust_lga=sanitize($_POST["cust_lga"]);
     
    
        if(isset($_POST["cust_gender"])){
            $cust_gender=$_POST["cust_gender"];
        }else{
            // exit();
            $cust_gender="";
        }
        
        // validation
        if(empty($cust_firstname) || empty($cust_lastname) || empty($cust_phone) || empty($cust_email) || empty($cust_gender) || empty($cust_dob) || empty($cust_password) || empty($confirm_password) || empty($cust_address) || empty($cust_state) || empty($cust_lga) ){

            $_SESSION["reg_error"]="All fields are required";
            header("location:../register.php");
           exit();
        }
        // validation for if password and confirm password doesn't match
        if($cust_password != $confirm_password){
            $_SESSION["reg_error"]="Password and confirm password do not match";
            header("location:../register.php");
            exit();
        }
        // validation for if password is less than 8 digits
        if(strlen($cust_password) < 8){
            $_SESSION["reg_error"]="Password must be 8 characters or more";
            header("location:../register.php");
            exit();
        }
        // encrypt password
        $hashed_password=password_hash($cust_password, PASSWORD_DEFAULT);

        $cust1= new Customer();
        $registered=$cust1->register_customer($cust_firstname,$cust_lastname,$cust_phone,$cust_email,$cust_gender,$cust_dob,$hashed_password,$cust_address, $cust_state,$cust_lga);

       echo $registered;
       header("location:../login.php");
    
    }
}else{
    header("location:../register.php");
}
?>