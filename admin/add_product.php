<?php 
session_start();
  error_reporting(E_ALL);
  require_once("Classes/Category.php");
  require_once("guards/admin_guard.php");
  $cat1= new Category();
  $category=$cat1->fetch_category();
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
        
          <!-- Form Section -->
          <div class="col">
          <?php 
                    if(isset($_SESSION["error"])){ 
                    
                    ?>

                    <div class="col-8 justify-content-center alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <p class="text-center, text-danger"><strong><?php echo $_SESSION["error"];?></strong></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <?php unset($_SESSION["error"]); ?>
                        
                  <?php } ?>
            <h2 class="text-center">Add Product</h2>
            <form action="process/product_process.php" method="post" enctype="multipart/form-data">
                <label for="prod_name" class="label-control">Product Name</label>
                <input type="text" name="prod_name" id="prod_name" class="form-control">

                <label for="prod_description" class="label-control">Product Description</label>
                <textarea name="prod_description" id="prod_description" cols="30" rows="10" class="form-control"></textarea>


                <label for="prod_image" class="label-control">Product Image</label>
                <input type="file" name="prod_image" id="prod_image" class="form-control">

                <label for="prod_image" class="label-control">Product Image</label>
                <input type="file" name="prod_image2" id="prod_image2" class="form-control">

                <label for="prod_amt" class="label-control">Product Amount</label>
                <input type="text" name="prod_amt" id="prod_amt" class="form-control">

                <label for="prod_category" class="label-control">Product Category</label>
                <select name="prod_category" id="prod_category" class="form-control">
                  <option value="">Select a category</option>
                  <?php 
                      foreach($category as $cat){

                  ?>
                        <option value="<?php echo $cat["category_id"]; ?>"><?php echo $cat["category_name"]; ?></option>
                  <?php 
                       }
                  ?>
                </select>

                <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-4">
                    <input type="submit" name="add_prod" id="add_prod" class="btn btn-secondary" value="Add Product">
                </div>
                

            </form>

          </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
        <script src="assets/js/jquery.js"></script>
        <!-- <script>
          $(document).ready(function(){
            var productName=$("#prod_name").val();
            var productDesc=$("#prod_description").val();
            var productImage=$("#prod_image").val();
            var productImage_=$("#prod_image2").val();
            var productAmount=$("#prod_amt").val();
            var productCat=$("#prod_category").val();
            if(productName=="" || productDesc=="" || productImage=="" || productImage_=="" || productAmount=="" || productCat==""){
              $("#add_prod").attr("disabled", "disabled");
            }else{
              $("#add_prod").removeAr("disabled", "disabled");
            }
          })
        </script> -->
          
       
</body>
</html>