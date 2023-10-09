<?php 
  session_start();
  include_once("guards/admin_guard.php");
  include_once("Classes/Admin.php");
   $order1= new Admin();
   $orders=$order1->fetch_all_orders();
//    if($orders){
//     print_r($orders);
//    }


?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2 id="top">Orders</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
        
            <div class="col table-responsive">
                <table class="table table-striped ">
                    <tr>
                        <th>SN</th>
                        <th> Total</th>
                        <th> Name</th>
                        <th> Phone</th>
                        <th> Address</th>
                        <th> State</th>
                        <th> LGA</th>
                        <th> Date</th>
                    </tr>
                    <?php
                        $counter=1; 
                        foreach($orders as $order){
                    ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $order["order_total"]; ?></td>
                            <td><?php echo $order["order_name"]; ?></td>
                            <td><?php echo $order["order_phone"]; ?></td>
                            <td><?php echo $order["order_address"]; ?></td>
                            <td><?php echo $order["state_name"]; ?></td>
                            <td><?php echo $order["order_lga"]; ?></td>
                            <td><?php echo $order["order_date"]; ?></td>
                        </tr>
                    <?php 
                        }
                    ?>
                </table>
            </div>
            <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>&nbsp;Back to top</a>
            </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>