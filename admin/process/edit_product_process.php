<?php 
session_start();
error_reporting(E_ALL);
require_once("../Classes/Product.php");
include_once("../utilities/sanitizer.php");
if($_POST){
    // print_r($_POST);

    if(isset($_POST["edit_btn"])){
        $product_name=sanitize($_POST["prod_name"]);
        $product_desc=sanitize($_POST["prod_desc"]);
        $product_image=$_FILES["prod_image"];
        $product_image2=$_FILES["prod_image2"];
        $product_price=sanitize($_POST["prod_amt"]);
        $product_category=sanitize($_POST["prod_cat"]);
        $prod_id=$_POST["prod_id"];

        if(empty($product_name) || empty($product_desc) || empty($product_image) || empty($product_image2) || empty($product_price) || empty($product_category) || empty($prod_id)){
            $_SESSION["error"]="All fields are required";
            header("location:../edit_product.php");
        }
        $error=$product_image["error"];
        $error2=$product_image2["error"];

        // file error validation
        if($error > 0 || $error2 > 0 ){
            $_SESSION["error"]="Please upload a valid file";
            header("location:../edit_product.php");
           exit();
       }

       // validate size
       $file_size=$product_image["size"];
       $file_size2=$product_image2["size"];
       if($file_size > 4097152 || $file_size2 > 4097152){
            $_SESSION["error"]="Your file can not be larger than 4mb";
            header("location:../edit_product.php");
            exit();
       }

       // validate file type via extension
       // allowed extensions
       $allowed=["png", "jpg","jpeg"];

       $filename= $product_image["name"];
       $filename2= $product_image2["name"];
       // trying to get the extension of the file the user uploaded
       $arrayfilename=explode(".", $filename);
       $arrayfilename2=explode(".", $filename2);
       $fileext=end($arrayfilename);
       $fileext2=end($arrayfilename2);
       // echo $fileext;

       // if the uploaded file is not in our list of acceptable file
       if(!in_array($fileext,$allowed)){
            $_SESSION["error"]="Please upload an image of type png or jpg";
            header("location:../edit_product.php");
            exit();
       }

       if(!in_array($fileext2,$allowed)){
        $_SESSION["error"]="Please upload an image of type png or jpg";
            header("location:../edit_product.php");
            exit();
      }

       // generate a unique file name for the file
       $final_filename="loafyou".time(). "." .$fileext;
       $final_filename2="loafyou".(time()+2). "." .$fileext2;
       $destination="../uploads/$final_filename";
       $destination2="../uploads/$final_filename2";
       // temporary file location
       $tempo=$product_image["tmp_name"];
       $tempo2=$product_image2["tmp_name"];
       //move_uploaded_file: function that moves file from temporary directory to server
       $file_uploaded=move_uploaded_file($tempo, $destination);
       $file_uploaded2=move_uploaded_file($tempo2, $destination2);
        echo $file_uploaded;

       if ($file_uploaded && $file_uploaded2) {
        // Both files were uploaded successfully, proceed with database update
        $product = new Product();
        $update = $product->edit_product($product_name, $product_desc, $final_filename, $final_filename2, $product_price, $product_category, $prod_id);
        
            if ($update) {
                $_SESSION["feedback"] = "$product_name edited Successfully";
                header("location:../product.php");
            } else {
                $url = "edit_product.php?id=$prod_id";
                header("location:$url");
                exit();
            }
    } else {
        // Handle file upload errors
        $_SESSION["error"] = "File upload failed. Please try again.";
        header("location:../edit_product.php");
        exit();
    }
    }
}else{
    header("location:../product.php");
}

?>