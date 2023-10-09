<?php 
error_reporting(E_ALL);
// check if user is not logged in
// how to know that? user_id will not be in session
// therefore redirect back to login page

if(!isset($_SESSION["admin_id"])){
    header("location:../index.php");
    exit();
}
?>