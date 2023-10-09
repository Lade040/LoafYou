<?php 
session_start();
error_reporting(E_ALL);

require_once("Classes/Product.php");
$prod1= new Product();
$product=$prod1->fetch_random_product();

?>
       <?php require_once("partials/navbar.php") ?>
    <!-- Carousel showing bakery products -->
        <div class="row" >
          <div class="col" >
              <div id="carouselAutoplaying" class="carousel slide " data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="ratio ratio-16x9">
                       <video src="assets/video/vid1.mp4" type="video/mp4" class="object-fit-md-contain" autoplay muted></video>
                    </div>
                      <div class="carousel-caption d-none d-md-block ">
                        <a href="shop.html" class="btn btn-lg shopnow">Shop Now</a>
                      </div>
                    </div>
                    <div class="carousel-item">
                    <div class="ratio ratio-16x9">
                       <video src="assets/video/vid4.mp4" type="video/mp4" class="object-fit-md-contain" autoplay muted></video>
                    </div>
                      <div class="carousel-caption d-none d-md-block ">
                        <a href="shop.html" class="btn btn-lg shopnow">Shop Now</a>
                      </div>
                    </div>
                    <div class="carousel-item">
                    <div class="ratio ratio-16x9">
                       <video src="assets/video/vid2.mp4" type="video/mp4" class="object-fit-md-contain" autoplay muted></video>
                    </div>
                      <div class="carousel-caption d-none d-md-block ">
                        <a href="shop.html" class="btn btn-lg shopnow" id="top">Shop Now</a>
                      </div>
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
          </div>
        </div>
      
        <!--Greetings -->
        <div class="row justify-content-center" id="greetings">
          <div class="col-md-6 text-center">
              <h2 class="pbold" >Welcome</h2>
              <p>Step into our bakery's cozy haven, where the aroma of freshly baked wonders welcomes you like a warm hug. Our physical shop is where flour-dusted dreams come true, offering a sweet escape from the hustle and bustle. From croissants that flake with perfection to cupcakes that are pure edible art, every treat is a testament to our passion for baking.</p>
              
              <p>If you're exploring our digital storefront, get ready for an online experience that's as delectable as our treats. Your taste buds are in for a rollercoaster of flavors, whether you're craving classic chocolate chip cookies or daring to try our latest experimental concoctions. Place an order and let us teleport these delights straight to your doorstep, because every bite is an adventure in itself.</p>

              <p>At our bakery, we believe in sprinkling joy, spreading smiles, and icing everything with a touch of happiness. Join us in celebrating life's sweet moments, big or small, because there's no day that can't be improved with a little frosting and a whole lot of love. So, whether you're visiting us in person or indulging from afar, remember: Life is uncertain, eat dessert first and savor every delightful bite!</p>
          </div>
        </div>
      
        <!-- Visit Us Section -->
        <div class="row ps-5 text-center">
          <div class="col" id="visit">
              <h2  class="pbold">Visit Our Bakery</h2>
          </div> 
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-4 pb-2">
              <img src="assets/images/shop.jpg" alt="bakery shop"  class="img-fluid">
          </div>
          <div class="col-md-4">
              <img src="assets/images/shop2.jpg" alt="bakery shop" class="img-fluid">
          </div>
          <div class="col-10 location">
            <h5>Visit us @ 172 Imagine Street,Lagos Nigeria</h5>
          </div>
        </div>
     
        <!-- Best seller section -->
        <div class="row text-center bestseller">
          <div class="col">
            <h2  class="pbold">Featured</h2>
          </div>
        </div>
        <div class="row justify-content-around text-center mt-5">
          <?php foreach($product as $prods){
            ?>
          <div class="col-md-2 mb-5">
              <img src="admin/uploads/<?php echo $prods["prod_img"] ?>" alt="<?php echo $prods["prod_name"] ?>" class="img-fluid">
              <p><?php echo $prods["prod_name"] ?></p>
              <h6 class="naira"><span class="naira">&#8358;</span><?php echo number_format($prods["prod_amt"]); ?></h6>
              <form method="post">
                    <input type="number" name="qty" class="form-control quantity" min="1" value="1" id="qty">
                      <button class="btn btn-outline-secondary proimage addbtn" name="cart_btn" data-product-id="<?php echo $prods["prod_id"]; ?>" >Add To Cart</button>
                    </form>
          </div>
          <?php } ?>
          <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
          
        </div>
        <!-- footer -->
        <?php include("partials/footer.php") ?>
      </div>
      <script src="assets/js/jquery.js"></script>
      <script>
        $(document).ready(function(){
          $(document).on("click",".addbtn", function(event){
                  event.preventDefault();
                  var prodId = $(this).data("product-id");
                  var quantity=$(".quantity").val();
                  // alert(prodId);
                var data={"productid":prodId,"quantity":quantity};
                console.log(data);
                $.ajax({
                  url:"process/cart_process.php",
                  data:data,
                  type:"POST",
                  dataType:"json",
                  success:function(response){
                    console.log(response);
                    $.ajax({
                      url: "cart_offcanvass.php",
                      type: "GET",
                      success: function(cartContent){
                        $(".offcanvas-body").html(cartContent);
                      },
                      error: function(xhr, status, error){
                        console.log(error);
                      }
                    });
                    $(".offcanvas").offcanvas('show');

                  },
                  error: function(xhr, status, error){
                    console.log(error);
                  }
                  
                })
              })
        })
      </script>
    </body>
</html>