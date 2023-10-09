<?php
session_start();
error_reporting(E_ALL);
include_once("../Classes/Category.php");
if($_POST){
    if(isset($_POST["delbtn"])){
        $cat_id=$_POST["cat_id"];

        $cat1= new Category();
        $deleted=$cat1->delete_category($cat_id);
        if($deleted){
           $_SESSION["feedback"]="Category deleted successfully";
           header("location:../category_page.php");
        }


    }
}

?>