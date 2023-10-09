<?php 
session_start();
 error_reporting(E_ALL);
 require_once("Classes/Product.php"); 
 require_once("Classes/Category.php");
  
 $pro1=new Product();
 $product=$pro1->fetch_all_product();
//  print_r($product);

 $cat1= new Category();
 $category= $cat1->fetch_category();
 ?>
 
    <!-- Navbar Section -->
            <?php include("partials/navbar.php") ?>
            <!-- Carousel showing bakery products -->
            <div class="row carousel" >
                <div class="col" >
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="assets/images/carousel1.jpg" class="d-block w-100" alt="ice cream cake">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/carousel2.jpg" class="d-block w-100" alt="chocolate cake">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/carousel3.jpg" class="d-block w-100" alt="pastries">
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
                    <h3 class="prodtag pbold" id="top">Products</h3>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-2 mb-2  ps-5">
                    <!-- <button class="btn btn-secondary btn-md" type="button" data-bs-toggle="dropdown" >
                      
                    </button> -->
                    <select class=" dropdown btn btn-secondary btn-md" id="dropdown">
                        <option value="all">Shop all Category</option>
                        <?php foreach($category as $cat){ ?>
                            <option class="bgbrown dropdown bg-secondary" value="<?php echo $cat["category_id"];?>"><?php echo $cat["category_name"];?></option>
                        <?php } ?>
                        </select>
                </div>

            </div>
            <div class="row justify-content-around text-center px-3" id="product">
                <?php 
                foreach($product as $pro){?>
                    <div class="col-md-3 mb-5" id="prod" data-category="<?php echo $pro["prodcategory_id"];?>">
                      
                    <a href="product.php?id=<?php echo $pro["prod_id"];?>"><img src="admin/uploads/<?php echo $pro["prod_img"];?>" alt="<?php echo $pro["prod_name"];?>" class="img-fluid imgs"></a>
                    <p><a href="product.php?id=<?php echo $pro["prod_id"];?>" class="imgnamelink"><?php echo $pro["prod_name"];?></a></p>
                    <h6>&#8358;<?php echo number_format($pro["prod_amt"]);?></h6>

                    <form method="post">
                    <input type="number" name="qty" class="form-control quantity" min="1" value="1" id="qty">
                      <button class="btn btn-outline-secondary proimage addbtn" name="cart_btn" data-product-id="<?php echo $pro["prod_id"]; ?>" >Add To Cart</button>
                    </form>

                    </div>
               <?php } ?>
            </div>
            <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
            <div class="row">
              <div class="col col-6  d-grid gap-2 mx-auto  mb-3 mt-5">
                <button class="btn btn-lg btn-outline-dark proimage">Load More</button>
              </div>
            </div>
            
            
            <!-- footer -->
            <?php include("partials/footer.php") ?>
        </div>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
          // script to control offcanvas on click of add to cart
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
                    $("#cartcount").text(response.cartcount);
                    $(".offcanvas").offcanvas('show');

                  },
                  error: function(xhr, status, error){
                    console.log(error);
                  }
                  
                })
              })
              
              
              //  little animation for shop products
              $(".imgs").on({
                mouseover:(function(){
                   $(this).fadeTo("slow",0.5);
                }),
                 mouseleave:(function(){
                  $(this).fadeTo("slow",1);
                 })
                 
              })
                    
                // script to organize products in categores
                $("#dropdown").change(function(){
                   
                var category=$(this).val();
                var data= {category: category };
                // if all category is clicked,call ajax to fetch products inside database
                  if(category=="all"){
                    $.ajax({
                      url: "process/productajax_process.php",
                      type: "POST",
                      data: { category: "all" },
                      dataType: "json",
                      success: function(response) {
                        var products=$("#product").empty();
                        $.each(response, function (index, product) {
                            
                            var productContainer = $('<div class="col-md-3 mb-5" id="prod">');
                            var amount=parseFloat(product.prod_amt);
                            var amountformat=amount.toLocaleString('en-IN');
                            productContainer.append('<a href="product.php?id=' + product.prod_id + '"><img src="admin/uploads/' + product.prod_img + '" alt="' + product.prod_name + '" class="img-fluid imgs" id="img"></a>');
                            productContainer.append('<p><a href="product.php?id=' + product.prod_id + '" class="imgnamelink">' + product.prod_name + '</a></p>');
                            productContainer.append('<h6>&#8358;' + amountformat.toLocaleString('en-US') + '</h6>');
                            productContainer.append('<form method="post"><button class="btn btn-outline-secondary proimage addbtn" name="cart_btn" data-product-id='+ product.prod_id +'>Add To Cart</button></form>');

                            $('#product').append(productContainer);

                          });
                      },
                      error: function(xhr, status, error) {
                          console.log(error);
                      }
                    });
                  }else{
                  $.ajax({
                      url:"process/productajax_process.php",
                      data:data,
                      type:"POST",
                      dataType:"json",
                      success: function(response){
                          console.log("response recieved;",response);
                          var products=$("#product").empty();

                      if (response.length === 0) {
                              products.append('<div>No product found</div>');
                              
                          }else{
                          
                              $.each(response, function (index, product) {
                            
                              var productContainer = $('<div class="col-md-3 mb-5" id="prod">');
                                var amount=parseFloat(product.prod_amt);
                                var amountformat=amount.toLocaleString('en-IN');
                              productContainer.append('<a href="product.php?id=' + product.prod_id + '"><img src="admin/uploads/' + product.prod_img + '" alt="' + product.prod_name + '" class="img-fluid imgs" id="img"></a>');
                              productContainer.append('<p><a href="product.php?id=' + product.prod_id + '" class="imgnamelink">' + product.prod_name + '</a></p>');
                              productContainer.append('<h6>&#8358;' + amountformat + '</h6>');
                              productContainer.append('<form method="post"><button class="btn btn-outline-secondary proimage addbtn" name="cart_btn" data-product-id='+ product.prod_id +'>Add To Cart</button></form>');

                              $('#product').append(productContainer);

                            });
                          } 
      
                    
                    }
                })
              }
              })
            })
           
        </script>
</body>
</html>