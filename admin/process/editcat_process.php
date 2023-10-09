<?php 
error_reporting(E_ALL);
require_once("../Classes/Category.php");
include_once("../utilities/sanitizer.php");
if($_POST){
    
    if(isset($_POST["edit_btn"])){
        $category_name=sanitize($_POST["cat_name"]);
        $category_id=$_POST["cat_id"];

        $category=new Category();
        $update=$category->update_category($category_name,$category_id);
        if($update){
            header("location:../category_page.php");
        }else{
            $url="editcategory.php?id=$category_id";
            header("location:$url");
            exit();
        }
    }
}else{
    header("location:../category_page.php");
}

?>