<?php
session_start();
error_reporting(E_ALL);
include_once("../utilities/sanitizer.php");
include_once("../Classes/Admin.php");
if($_POST){
    if(isset($_POST["login_btn"])){
        $admin_email=sanitize($_POST["admin_email"]);
        $admin_password=sanitize_pass($_POST["admin_password"]);

        if(empty($admin_email) || empty($admin_password)){
            $_SESSION["login_error"]="All fields are required";
            header("location:../login.php");
            exit();
        }

        $admin1= new Admin();
        $response=$admin1->login_admin($admin_email,$admin_password);

        if($response){
            $_SESSION["login_error"]="Either email or password is wrong";
            header("location:../profile.php");
            exit();
        }

        header("location:../profile.php");
    }
}else{
    header("location:../../login.php");
}
?>