<?php 
session_start();
error_reporting(E_ALL);
include_once("../Classes/Category.php");
include_once("../utilities/sanitizer.php");
if($_POST){

    if(isset($_POST["add_btn"])){
        $category_name=sanitize($_POST["category"]);

        if(empty($category_name)){
            $_SESSION["cat_error"]="Input Field Cannot Be Empty";
            header("location:../category_page.php");
            exit();
        }

        $cat1= new Category();
        $category=$cat1->add_category($category_name);
        if($category){
            $_SESSION["cat_success"]="$category_name. added successfully";
            header("location:../category_page.php");
        }
        
    }
}else{
    header("location:..category_page.php");
}
?>