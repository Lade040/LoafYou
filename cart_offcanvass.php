

<?php
session_start();
require_once("Classes/Product.php");


if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        // 
        $pro1 = new Product();
        $productDetails = $pro1->get_product_detail($productId);

        //  product information and links
        echo "<div class='row mb-3'><div class='col-10'>";
        echo "<a href='product.php?id=$productId'><img src='admin/uploads/{$productDetails['prod_img']}' class='img-fluid mb-2'></a><br>";
        echo "Price: &#8358;{$productDetails['prod_amt']} x <input type='number' min='1' class='quantity-input col-2' data-product-id='$productId' value='$quantity'>&nbsp;&nbsp;";
        echo "<button class='btn btn-sm btn-danger remove-btn'><i class='fa-solid fa-trash'></i></button>";
        echo "</div>";
        echo "<div class='col-6 mt-2'><h6>{$productDetails['prod_name']}</h6></div></div>";
    }
    //  links to view cart or proceed to checkout
    echo "<div class='row mt-5 mb-5'><div class='col mx-auto'>
    <a href='cart.php' class='btn btn-lg  btn-outline-secondary mb-2 col-12'>View Cart</a></div>";
    echo "<div><a href='checkout.php' class='btn btn-lg   mb-2 col-12 proimage btn-outline-secondary'>Proceed to Checkout</a></div></div>";
    
} else {
    echo "<div class='text-center'>Your cart is empty.</div>";
}

?>
<script src="assets/js/jquery.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
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