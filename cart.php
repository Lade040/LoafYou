<?php 
session_start();
require_once("Classes/Product.php");
$totalPrice = 0;

?>
    <!-- Navbar Section -->
    <?php include("partials/navbar.php"); ?>

    <!-- Cart Section -->
    <div class="row justify-content-center mt-5 cartsection" id="">
      <div class="col mt-3">
        <h3 class="text-center pbold">Shopping Cart</h3>
      </div>
    <?php
         if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $productId => $quantity) {
              // Fetch product details using $productId from your database (Product class assumed)
              $pro1 = new Product();
              $productDetails = $pro1->get_product_detail($productId);
              $subtotal=$productDetails['prod_amt'] * $quantity;
              $subtotals[]=$subtotal;
              // Display product information and create links
              echo "<div class='row mb-3 mt-5 justify-content-center' id='content'><div class='col-md-5'>";
              echo "<a href='product.php?id=$productId'><img src='admin/uploads/{$productDetails['prod_img']}' class='img-fluid mb-2'></a><br>";
              echo "<span>{$productDetails['prod_name']}<span>&nbsp;&nbsp;Price: &#8358;{$productDetails['prod_amt']} x <input type='number' min='1' class='quantity-input col-2' data-product-id='$productId' value='$quantity'>&nbsp;&nbsp;Subtotal: $subtotal &nbsp;&nbsp;";
              echo "<button class='btn btn-sm btn-danger remove-btn'><i class='fa-solid fa-trash'></i></button>";
              echo "</div></div>";
          }
          $totalPrice=array_sum($subtotals);
          echo "<div><h4 class='text-end me-5'>Total:&#8358;$totalPrice </h4></div>";
          // links to view cart or proceed to checkout
          echo "<div class='mt-5 mb-5 justify-content-center'><div class='row justify-content-center'><div class='col-8 d-grid gap-2 mx-auto'> <a href='checkout.php' class='btn btn-lg mb-2 proimage btn-outline-secondary'>Proceed to Checkout</a></div></div>";
          
      } else {
          echo "<div><h4 class='text-center' >Your cart is empty.</h4></div>";
      }
    
    
    ?>
       </div>
       

    <!-- Footer -->
    <?php include("partials/footer.php"); ?>
    <script src ="assets/js/jquery.js"></script>
  <script>
    $(document).ready(function(){
      function updateCartQuantity(productId, newQuantity) {
                  $.ajax({
                      url: "update_cart.php",
                      method: "post",
                      data: { productId: productId, quantity: newQuantity },
                      dataType: "json",
                      success: function (response) {
                        console.log(response);
                      },
                      error: function (error) {
                        console.log(error);
                      }
                   });
               }

               function removeProductFromCart(productId) {
              $.ajax({
                 url: "remove_from_cart.php",
                 method: "post",
                 data: { productId: productId },
                 dataType: "json",
                 success: function (response) {
                  console.log(response);
                },
                 error: function (error) {
                  console.log(error);
             }
            });
            }
            
            
        $(".quantity-input").on("change", function () {
                 var productId = $(this).data("product-id");
                 var newQuantity = parseInt($(this).val());
                //  alert(productId);
                //  alert(newQuantity);
                 updateCartQuantity(productId, newQuantity);
                 showOffcanvasContent()
               });

              $(".remove-btn").on("click", function () {
                var productId = $(this).closest(".row").find(".quantity-input").data("product-id");
                //  alert(productId);
                 removeProductFromCart(productId);
                 showOffcanvasContent()
               });
               function showOffcanvasContent() {
        $.ajax({
            url: "ajax_cart.php", 
            type: "GET",
            success: function(cartContent) {
                $(".cartsection").html(cartContent);
                var offcanvasElement = document.getElementById('content');
                offcanvasElement.show(); 
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
     }
              

              

    })
</script>
</body>
</html>
