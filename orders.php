<?php 
session_start();
error_reporting(E_ALL);
require_once("Classes/Order.php");
if(isset($_SESSION["cust_id"])) {
  $order1 = new Order();
  $orders = $order1->fetch_order( $_SESSION["cust_id"]);
  // print_r($orders);
} else {
  header("location:index.php");
  
}

// echo $_SESSION["cust_id"];






$count=1;

?>
        <!-- Navbar Section -->
        <?php require_once("partials/navbar.php");?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2>My Account</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <div class="row dashboard" >
        <?php require_once("partials/dashboard.php"); ?>

          <div class="col responsive-table">
              <h2 class="text-center mb-5 pbold">Order History</h2>

              <table class="table table-striped">
                  <thead>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Date</th>
                  </thead>
                  <tbody>

                    <?php foreach($orders as $order){
                         
                      ?>
                            <tr>
                              <td><?php echo $count++; ?></td>
                              <td><?php echo $order["order_id"]; ?></td>
                              <td><?php echo $order["prod_name"]; ?></td>
                              <td><?php echo $order["order_quantity"]; ?></td>
                              <td>&#8358;<?php echo number_format($order["order_subtotal"]); ?></td>
                              <td><?php echo $order["order_date"]; ?></td>

                            </tr>

                    <?php } ?>
                  </tbody>
                  <h4>TOTAL:&#8358;<?php echo number_format($order["order_total"]); ?></h4>
              </table>
              
          </div>
        </div>
        <!-- footer -->
        <?php include("partials/footer.php") ?>
    </div>
</body>
</html>