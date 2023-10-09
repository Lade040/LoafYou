<?php 
session_start();
  error_reporting(E_ALL);
  include_once("guards/admin_guard.php");
  require_once("Classes/Product.php");
  require_once("Classes/Category.php");
  $prod1= new Product();
  $product=$prod1->fetch_all_product();
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

          
          <div class="col table-responsive">
              <a href="add_product.php" class="btn btn-secondary" id="top">Add Product</a>

              <div class="row">
                <div class="col-12">
                   <?php 
                    if(isset($_SESSION["feedback"])){ 
                    
                    ?>

                    <div class="col-8 justify-content-center alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <p class="text-center, text-danger"><strong><?php echo $_SESSION["feedback"];?></strong></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <?php unset($_SESSION["feedback"]); ?>
                        
                  <?php } ?>
                </div>
              </div>
                      <div class="col-12">
                      <table class="table table-striped mt-3">
                          <th>S/N</th>
                          <th>Product Name</th>
                          <th>Product Price</th>
                          <th>Product Category</th>
                          <th>Action</th>
                          <?php
                            $counter=1;
                              foreach($product as $prod){
                          ?>
                                  <tr>
                                      <td><?php echo $counter++; ?></td>
                                      <td><?php echo $prod["prod_name"]; ?></td>
                                      <td><?php echo $prod["prod_amt"]; ?></td>
                                      <td><?php
                                        foreach($category as $cat){
                                          if($prod["prodcategory_id"]==$cat["category_id"]){
                                            echo $cat["category_name"];
                                          }
                                        }
                                      ?>
                                      </td>
                                      <td class="actiondisplay">
                                      <a href="more_prod_detail.php?id=<?php echo $prod["prod_id"];?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-info"></i>&nbsp;&nbsp;More</a>&nbsp;
                                      <a href="edit_product.php?id=<?php echo $prod["prod_id"];?>" class="btn btn-sm btn-secondary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                                      &nbsp;<form action="process/delete_product_process.php" method="post">
                                    <input type="hidden" name="prod_id" value="<?php echo $prod["prod_id"]?>">
                                    <button type="submit" class='btn btn-sm btn-danger' name="delbtn"><i class='fa fa-trash'></i>&nbsp;Delete</button>
                                    </form></td>
                                  </tr>
                          <?php
                              }
                          ?>
                        </table>
                      </div>
                      <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
          </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>