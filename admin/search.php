<?php 
error_reporting(E_ALL);
require_once("Classes/Product.php");
include_once("utilities/sanitizer.php");
if(isset($_GET["search"])){
    $search=sanitize($_GET["search"]);

    $pro1=new Product();
    $product=$pro1->search_product($search);
}
// echo "Form submitted";

?>
    <!-- Navbar Section -->
            <?php include("partials/navbar.php") ?>
            <!-- Carousel showing bakery products -->
            <div class="row carousel" >
                <div class="col" >
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="../assets/images/carousel1.jpg" class="d-block w-100" alt="ice cream cake">
                          </div>
                          <div class="carousel-item">
                            <img src="../assets/images/carousel2.jpg" class="d-block w-100" alt="chocolate cake">
                          </div>
                          <div class="carousel-item">
                            <img src="../assets/images/carousel3.jpg" class="d-block w-100" alt="pastries">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col mb-3 ">
                    <h3 class="prodtag">Search Result</h3>
                </div>
            </div>
          
            <div class="row justify-content-around text-center px-3" id="product">
                <?php if(!empty($product)) {
                  foreach($product as $pro){?>
                    <div class="col-md-3 mb-5" id="prod">
                      
                    <a href="product.php?id=<?php echo $pro["prod_id"];?>"><img src="uploads/<?php echo $pro["prod_img"];?>" alt="<?php echo $pro["prod_name"];?>" class="img-fluid imgs"></a>
                    
                    <p><a href="product.php?id=<?php echo $pro["prod_id"];?>" class="imgnamelink"><?php echo $pro["prod_name"];?></a></p>

                    <h6>&#8358;<?php echo number_format($pro["prod_amt"]);?></h6>
                    
                    <form action="process/cart_process.php" method="post">
                      <input type="hidden" name="product_id" value="<?php echo $pro["prod_id"]; ?>">
                      <input type="number" name="prod_qty" id="qty" value="1" min="1" class="qty">
                    </form>

                    </div>
               <?php }
                    } else{
                      echo "<h4>No product found</h4>";
                    }
               ?>
            </div>

            
            
            <!-- footer -->
            <?php include("partials/footer.php") ?>
        </div>
</body>
</html>