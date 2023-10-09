<?php 
  session_start();
  require_once("guards/admin_guard.php");
  require_once("Classes/Product.php");

  
  // print_r($category);
  if(isset($_GET["id"])){
    $prod_id=$_GET["id"];
    if(!is_numeric($prod_id)){
        header("location:category_page.php");
      }

    $prod1= new Product();
    $product=$prod1->get_product_detail($prod_id);  
    if(!$product){
        header("location:product.php");
        exit();
      }
    }else{
      header("location:product.php");
    }
 
?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2>Product</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
          
          

          <div class="col">
            <div>
                <div>
                <?php 
                    if(isset($_SESSION["error"])){ 
                    
                    ?>

                    <div class="col-8 justify-content-center alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <p class="text-center, text-danger"><strong><?php echo $_SESSION["error"];?></strong></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <?php unset($_SESSION["error"]); ?>
                        
                  <?php } ?>
                </div>
            </div>
            <h2 class="text-center mb-3" id="top">Edit Product</h2>
            <form action="process/edit_prodimg_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="prod_id" value="<?php echo $product["prod_id"]; ?>" >
                <label for="prod_name" class="form-label">Product Name</label>
                <input type="text" name="prod_name" id="prod_name" class="form-control" value="<?php echo $product["prod_name"]; ?>" >

                <label for="prod_desc" class="form-label">Product Description</label>
                <textarea name="prod_desc" id="prod_desc" cols="30" rows="10"  class="form-control" ><?php echo $product["prod_desc"]; ?></textarea>
              
                <label for="prod_image" class="form-label">Product Image</label>
                <input type="file" name="prod_image" id="prod_image" class="form-control" value="<?php echo $product["prod_img"]; ?>" r>
                    
                <label for="prod_image2" class="form-label">Product Image</label>
                <input type="file" name="prod_image2" id="prod_image2" class="form-control" value="<?php echo $product["prod_img2"]; ?>" readonly>

                   
                <label for="prod_amt" class="form-label">Product Price</label>
                <input type="text" name="prod_amt" id="prod_amt" class="form-control" value="<?php echo $product["prod_amt"]; ?>" >

                <label for="category" class="form-label">Product Category</label>
                <input type="text" name="prod_cat" id="prod_cat" class="form-control" value="<?php echo $product["prodcategory_id"]; ?>" >
               

                <div class="d-grid gap-2 col-4 mx-auto mt-4 mb-4">
                    <input type="submit" name="edit_btn" class="btn btn-secondary" value="Edit">
                </div>
                
            </form>

              
          </div>
          <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>