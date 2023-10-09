<?php
session_start();
error_reporting(E_ALL);
include_once("guards/cust_guard.php");
require_once("Classes/Product.php");
if(isset($_GET)){
    $product_id=$_GET["id"];

    if(!is_numeric($product_id)){
        header("location:product.php");
    }

    $prod1= new Product();
    $product=$prod1->get_product_detail($product_id);  
    if(!$product){
        header("location:product.php");
        exit();
    }
}else{
      header("location:index.php");
}
if(isset($_SESSION)){
    $cust_id=$_SESSION["cust_id"];
}
?>  
      <!-- code to handle reviews -->
      
      <!-- Navbar Section -->
        <?php include("Partials/navbar.php") ?> 
         <!-- Login or register section -->
        <div class="row justify-content-center reviewform mt-5" id="review">
          <h4 class="text-center mt-5 pbold">Review</h4>
          <div class="col-8">
          <?php 
            if(isset($_SESSION["feedback"])){ 
            
            ?>
            
            <div class="col-8 justify-content-center alert alert-dark alert-dismissible fade show" role="alert">
            <p class="text-center, text-danger"><strong><?php echo $_SESSION["feedback"];?></strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <?php unset($_SESSION["feedback"]); ?>
                
           <?php } ?>
          </div>
          <div class="col-8 mt-5" >
            <form action="process/review_process.php" method="post" id="review">
              <input type="hidden" name="prod_id" value="<?php echo $product["prod_id"]; ?>">

              <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">

              <label for="ratings" class="label-control">Your Ratings</label>
              <input type="number" class="form-control" name="ratings" min="1" max="5">
              
              <label for="review" class="label-control">Your Review</label>
              <textarea name="rev_text" id="review" cols="30" rows="10" class="form-control"></textarea>

              <input type="hidden" id="name" name="name" class="form-control" value="">

              <input type="hidden" id="email" name="email" class="form-control" value="">

              <div class="d-grid gap-2 col-6 mx-auto mt-5">
                <input type="submit" name="rev_btn" id="login" value="Submit" class="btn btn-large btn-outline-dark mb-5 proimage " >
              </div>
              </form>
          </div>
             
          </div>
    
            
        <!-- footer -->
        <?php include("partials/footer.php") ?>
  </div>
  <script src="assets/js/jquery.js"></script>
  <script>
    
  </script>
</body>
</html>