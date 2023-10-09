<?php 
  session_start();
  include_once("Classes/Category.php");
  require_once("guards/admin_guard.php");
  $cat1= new Category();
  $category=$cat1->fetch_category();
  // print_r($category);
?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2 id="top">Categories</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>

          <div class="col">
            <a href="addcategory.php" class="btn btn-secondary">Add Category</a>
            <!-- Text alert starts here -->
            <div class="row">
                <div class="col mt-3">
                    <?php 
                    if(isset($_SESSION["feedback"])){ 
                    
                    ?>
                    
                    <div class="col-8 justify-content-center alert alert-success alert-dismissible fade show" role="alert">
                    <p class="text-center, text-danger"><strong><?php echo $_SESSION["feedback"];?></strong></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <?php unset($_SESSION["feedback"]); ?>
                        
                  <?php } ?>
                  
                  <?php 
                if(isset($_SESSION["cat_error"])){ 
                
                ?>
                <div class="col-8 alert alert-light alert-dismissible fade show" role="alert">
                <p class="text-center, text-danger"><strong><?php echo $_SESSION["cat_error"];?></strong></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                <?php unset($_SESSION["cat_error"]); ?>
                    
                <?php } ?>

                <?php 
                if(isset($_SESSION["cat_success"])){ 
                
                ?>
                <div class="col-8 alert alert-success alert-dismissible fade show" role="alert">
                <p class="text-center, text-light"><strong><?php echo $_SESSION["cat_success"];?></strong></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
                <?php unset($_SESSION["cat_success"]); ?>
                    
                <?php } ?>
            
                </div>
            </div>
            <!-- Text alert ends here -->
          
            <div class="row mt-3">
                <div class="col">
                  <table class="table table-striped">
                    <tr>
                      <th>#</th>
                      <th>Category Name</th>
                      <th>Action</th>
                      <?php
                        $count=1;
                      ?>
                    </tr>
                      <?php 
                        foreach($category as $cat1){

                      ?>
                        <tr class="trows">
                          <td><?php echo $count++?></td>
                          <td><?php echo $cat1["category_name"];?>
                          <td class="actiondisplay">
                            <a href="editcategory.php?id=<?php echo $cat1["category_id"];?>" class="btn btn-sm btn-secondary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                            &nbsp;<form action="process/delete_category_process.php" method="post">
                          <input type="hidden" name="cat_id" value="<?php echo $cat1["category_id"];?>">
                          <button type="submit" class='btn btn-sm btn-danger' name="delbtn"><i class='fa fa-trash'></i>&nbsp;Delete</button>
                          </form></td>
                      </tr>
                      <?php 
                        }
                      ?>
                  </table>
                </div>

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