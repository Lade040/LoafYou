<?php 
session_start();
  error_reporting(E_ALL);
  require_once("guards/admin_guard.php");
  require_once("Classes/Product.php");
  
  if(isset($_GET["id"])){
    $prod_id=$_GET["id"];
    if(!is_numeric($prod_id)){
        header("location:product.php");
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
              <h2 id="top">Product Name:</h2>
              <p><?php echo $product["prod_name"]; ?></p>
              <div class="row">
                <div class="col-6">
                    <img src="uploads/<?php echo $product["prod_img"]; ?>" alt="" class="img-fluid">
                    <p>Price:&#8358;<?php echo $product["prod_amt"]; ?></p>
                </div>
                <div class="col-6">
                    <img src="uploads/<?php echo $product["prod_img2"]; ?>" alt="" class="img-fluid">
                </div>
              </div>
                <h2>Product Description:</h2>
                <p><?php echo $product["prod_desc"]; ?></p>


              
          </div>
          <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>