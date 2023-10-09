<?php 
session_start();
error_reporting(E_ALL);
include_once("../utilities/sanitizer.php");
include_once("../Classes/Admin.php");
if($_POST){
    if(isset($_POST["reg_btn"])){
        $admin_email=sanitize($_POST["admin_email"]);
        $admin_password=sanitize_pass($_POST["admin_password"]);
        $admin_cpassword=sanitize_pass($_POST["admin_cpassword"]);
       
        
        // validation
        if(empty($admin_email) || empty($admin_password) || empty($admin_cpassword)){
            $_SESSION["reg_error"]="All fields are required";
            header("location:../register.php");
            exit();
        }

        if($admin_password != $admin_cpassword){
            $_SESSION["reg_error"]="Password and confirm password do not match";
            header("location:../register.php");
            exit();
        }

        if(strlen($admin_password) < 8){
            $_SESSION["reg_error"]="Password must be 8 characters or more";
            header("location:../register.php");
            exit();
        }

        $hashed_password=password_hash($admin_cpassword, PASSWORD_DEFAULT);

        $admin1= new Admin();
        $feedback=$admin1->register_admin($admin_email,$hashed_password);
        echo $feedback;
    
        header("location:../login.php");
    }
}else{
    header("location:../../index.php");
}
?>