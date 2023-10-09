<?php 
  session_start();
  include_once("guards/admin_guard.php");
  include_once("Classes/Admin.php");
   $order1= new Admin();
   $orders=$order1->fetch_order_item();
   
//    if($orders){
//     print_r($pay);
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
                <h2 id="top">Order Details</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
        
            <div class="col table-responsive" >
                <table class="table table-striped">
                    <tr>
                        <th>SN</th>
                        <th> Order Customer</th>
                        <th> Product</th>
                        <th> Quantity</th>
                        <th> Date</th>
                        
                    </tr>
                    <?php
                        $counter=1; 
                        foreach($orders as $order){
                
                    ?>
                        <tr>

                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $order["cust_firstname"]; ?></td>
                            <td><?php echo $order["prod_name"] ?></td>
                            <td><?php echo $order["order_quantity"]  ?></td>
                            <td><?php  echo $order["order_time"]?></td>
                        </tr>
                    <?php 
                        }
                    ?>
                </table>
            </div>
            <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
        </div>
        
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>