<?php 
  session_start();
  require_once("guards/admin_guard.php");

?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2>Categories</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
          

          <div class="col">
            
          <h5 class="text-center mt-5">Add Category</h5>

              <div>
                    <form action="process/category_process.php" method="post">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" name="category" class="form-control mb-4">
                        
                        <div class="d-grid gap-2 col-4 mx-auto">
                            <input type="submit" name=add_btn class="btn btn-secondary">
                        </div>
                        
                    </form>
              </div>

              
          </div>
          
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>