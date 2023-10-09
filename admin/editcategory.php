<?php 
  session_start();
  require_once("guards/admin_guard.php");
  require_once("Classes/Category.php");

  
  // print_r($category);
  if(isset($_GET["id"])){
    $cat_id=$_GET["id"];
    if(!is_numeric($cat_id)){
        header("location:category_page.php");
      }

    $cat1= new Category();
    $category=$cat1->fetch_category_detail($cat_id);  
    if(!$category){
        header("location:category_page.php");
        exit();
      }
    }else{
      header("location:category_page.php");
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
                <h2 id="top">Categories</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
          

          <div class="col">
            <h2 class="text-center">Edit Category</h2>
            <form action="process/editcat_process.php" method="post">
                <input type="hidden" name="cat_id" value="<?php echo $category["category_id"]; ?>">
                <label for="category" class="form-label">Category Name</label>
                <input type="text" name="cat_name" id="cat_name" class="form-control" value="<?php echo $category["category_name"]; ?>">
                <div class="d-grid gap-2 col-4 mx-auto mt-4">
                    <input type="submit" name="edit_btn" class="btn btn-primary" value="Edit">
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