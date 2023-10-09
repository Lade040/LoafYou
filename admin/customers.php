<?php 
  session_start();
  include_once("guards/admin_guard.php"); 
  include_once("Classes/Customer.php");
  $cust1= new Customer();
  $customers=$cust1->fetch_customers();

    // echo "<pre>";
    // print_r($customers);
    // echo "</pre>";
?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2 id="top">Customers</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
          <div class="col table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>S/N</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>DOB</th>
                    </tr>
                    <?php
                    $counter=1;
                        foreach($customers as $cust){

                    ?>
                            <tr>
                                <td><?php echo $counter++?></td>
                                <td><?php echo $cust["cust_firstname"]?></td>
                                <td><?php echo $cust["cust_lastname"]?></td>
                                <td><?php echo $cust["cust_phone"]?></td>
                                <td><?php echo $cust["cust_email"]?></td>
                                <td><?php echo $cust["cust_gender"]?></td>
                                <td><?php echo $cust["cust_dob"]?></td>
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