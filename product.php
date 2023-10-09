<?php 
session_start();
error_reporting(E_ALL);
require_once("Classes/Product.php");
require_once("Classes/Review.php");
if(isset($_GET)){
    $product_id=$_GET["id"];

    if(!is_numeric($product_id)){
        header("location:shop.php");
    }

    $prod1= new Product();
    $product=$prod1->get_product_detail($product_id); 
    $rev1=new Review();
    $product_review=$rev1->fetch_review($product_id);
    $average_review=$rev1->average_review($product_id);
    // echo $average_review["average_rating"];
    
    // print_r($product_review);
    if(!$product){
        header("location:shop.php");
        exit();
    }
}else{
      header("location:index.php");
}

?>
<!-- lines of code for product page -->
 <!-- Navbar Section -->
 <?php include "partials/navbar.php"?>
    <div class="row mt-2">
        <!-- product image,name price and description -->
        <div class="col-md-6 images">
            <img src="admin/uploads/<?php echo $product["prod_img"]?>" alt="<?php echo $product["prod_name"]?>" class="img-fluid ps-3">
            <img src="admin/uploads/<?php echo $product["prod_img2"]?>" alt="<?php echo $product["prod_name"]?>" class="img-fluid mt-3 ps-3 mb-5">
            </div>
        <div class="col-md-6 prodname px-3">
            <h2 class="text-center pbold"><?php echo $product["prod_name"];?></h2>
            <p class="amt">&#8358;<?php echo number_format($product["prod_amt"]);?></p>
                <h6 class="desctext">Description</h6>
                <p>Quantity</p>
            <div class="row">
                <div class="col-2">
                    <form method="post">
                        <input type="number" name="qty" class="form-control quantity" min="1" value="1">
                </div>
                <div class="col-9 d-grid gap-2 ">
                    <button class="btn btn-outline-secondary proimage col-9 d-grid gap-2 addbtn" name="cart_btn" data-product-id="<?php echo $product_id; ?>">Add to Cart</button>
                        </form>
                    </div>
                </div>
                
            <div class="row mt-5">
                   <div class="row">
                        <div class="col">

                        <?php 
                            if(isset($_SESSION["feedback"])){ 
                            
                            ?>
                            
                            <div class="col justify-content-center alert alert-light alert-dismissible fade show" role="alert">
                            <p class="text-center, text-dark"><strong><?php echo $_SESSION["feedback"];?></strong></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            
                            <?php unset($_SESSION["feedback"]); ?>
                                
                            <?php } ?>

                        </div>

                   </div>
                    <div class="col">
                        <div class="accordion" id="accordionPanelsStayOpenExample" >
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Description
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                    <?php echo $product["prod_desc"];?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <!-- accordion part handling review -->
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        Reviews
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="col align-self-end">
                                            <a href="review.php?id=<?php echo $product["prod_id"];?>" class="btn btn-secondary">Add Review</a>
                                        </div>
                                        <p>You have to login and have purchased this product to leave a review</p>
                                        <h5 class="text-center"><b>Reviews</b>&nbsp;&nbsp;&nbsp;<span>AVG Rating:<?php echo $average_review["average_rating"]; ?></span></h5>
                                        <?php 
                                            foreach($product_review as $review){
                                                $reviewer=$rev1->fetch_reviewer($review["cust_id"]);  
                                        ?>
                                            <div class="mt-4">
                                                <p><?php echo $reviewer["cust_firstname"] ?>&nbsp;&nbsp;<span>Rating:&nbsp;<?php echo $review["ratings"]; ?></span></p>
                                                <p><?php echo $review["rev_text"]; ?></p>
                                                <?php
                                                     if (isset($_SESSION["cust_id"]) && $review['cust_id'] == $_SESSION["cust_id"]) { ?>
                                                        <div class="btn-group">
                                                            
                                                        
                                                                <form class="">
                                                                <input type="hidden" value="<?php echo $review["cust_id"] ?>" id="cust_id" >
                                                                <input type="hidden" value="<?php echo $review["rev_id"] ?>" id="rev_id">
                                                                <input type="hidden" value="<?php echo $product_id; ?>" id="prod_id">
                                                                <button class="btn btn-sm btn-danger" id="delrev">Delete</button>
                                                            
                                                        </form>
                                                        </div>

                                                   <?php } ?>
                                                
                                            </div>
                                                <?php if(isset ($_SESSION["cust_"]))?>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- footer -->
       
      
    <?php include("partials/footer.php") ?>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // console.log("Script loaded!"); 
        // code that handles addition of product to cart on click of add to cart button
    $(document).ready(function(){
        $(document).on("click",".addbtn", function(event){
            event.preventDefault(); 
                
            var quantity=$(".quantity").val();
            var prodId = $(this).data("product-id");
            // alert(quantity);
            var data={"productid":prodId,"quantity":quantity};
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
             });
    });
        // this code handles deletion of review
            $("#delrev").click(function(event){
                event.preventDefault();
                var cust_id=$("#cust_id").val();
                var rev_id=$("#rev_id").val();
                var prod_id=$("#prod_id").val();
                var data={"cust_id":cust_id,"rev_id":rev_id,"prod_id":prod_id};
                console.log(data);

                $.ajax({
                    url:"process/delete_review.php",
                    data:data,
                    dataType:"json",
                    type:"POST",
                    success:function(response) {
                        if (response.success) {
                            console.log("Review deleted successfully");
                         }else {
                            console.log("Failed to delete review");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error: " + error);
                    }

                })


            })
   
  });

    </script>
    </body>
</html>