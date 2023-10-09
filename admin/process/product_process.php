<?php 
session_start();
error_reporting(E_ALL);
require_once("../Classes/Product.php");
include_once("../utilities/sanitizer.php");
if($_POST){
  //  echo "<pre>";
  //   print_r($_FILES);
  // echo "</pre>";
    if(isset($_POST["add_prod"])){
        $productname=sanitize($_POST["prod_name"]);
        $productdescription=sanitize($_POST["prod_description"]);
       
        $productamount=sanitize($_POST["prod_amt"]);
        $productcategory=$_POST["prod_category"];
        //  print_r($_FILES["prod_image"]);
        $productimage=$_FILES["prod_image"];
        $productimage2=$_FILES["prod_image2"];
        $error=$productimage["error"];
        $error2=$productimage2["error"];
        if(empty($productname) || empty($productdescription) || empty($productamount) || empty($productcategory) || empty($productimage) || empty($productimage2)){
          $_SESSION["error"]="All fields are required";
          header("location:../add_product.php");
          exit();
        }
        // file error validation
        if($error > 0 || $error2 > 0 ){
          $_SESSION["error"]="Please upload a valid file";
          header("location:../product.php");
           exit();
       }

       // validate size
       $file_size=$productimage["size"];
       $file_size2=$productimage2["size"];
       if($file_size > 4097152 || $file_size2 > 4097152){
          $_SESSION["error"]="Your file can not be larger than 4mb";
          header("location:../product.php");
           exit();
       }

       // validate file type via extension
       // allowed extensions
       $allowed=["png", "jpg","jpeg"];

       $filename= $productimage["name"];
       $filename2= $productimage2["name"];
       // trying to get the extension of the file the user uploaded
       $arrayfilename=explode(".", $filename);
       $arrayfilename2=explode(".", $filename2);
       $fileext=end($arrayfilename);
       $fileext2=end($arrayfilename2);
       // echo $fileext;

       // if the uploaded file is not in our list of acceptable file
       if(!in_array($fileext,$allowed)){
        $_SESSION["error"]="Please upload an image of type png or jpg";
          header("location:../product.php");
           exit();
       }

       if(!in_array($fileext2,$allowed)){
        $_SESSION["error"]="Please upload an image of type png or jpg";
          header("location:../product.php");
          exit();
      }

       // generate a unique file name for the file
       $final_filename="loafyou".time(). "." .$fileext;
       $final_filename2="loafyou".(time()+2). "." .$fileext2;
       $destination="../uploads/$final_filename";
       $destination2="../uploads/$final_filename2";
       // temporary file location
       $tempo=$productimage["tmp_name"];
       $tempo2=$productimage2["tmp_name"];
       //move_uploaded_file: function that moves file from temporary directory to server
       $file_uploaded=move_uploaded_file($tempo, $destination);
       $file_uploaded2=move_uploaded_file($tempo2, $destination2);
       
       if($file_uploaded && $file_uploaded2){
            $pro= new Product();
            $response= $pro->insert_product($productname,$productdescription,$final_filename,$final_filename2,$productamount,$productcategory);
       if($response){
        $_SESSION["feedback"]="$productname added successfully";
         header("location:../product.php");
       }
     }

    }
    
}else{
  header("location:../login.php");
}

?>