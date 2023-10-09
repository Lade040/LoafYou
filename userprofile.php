<?php 
 session_start();
  error_reporting(E_ALL);
 
  include_once("guards/cust_guard.php");
  require_once("Classes/Customer.php");

  if(isset($_SESSION["cust_id"])){
    $cust_id= $_SESSION["cust_id"];
    $customer1= new Customer();
    $customer =$customer1->fetch_details($cust_id);
}
?>     
      
      <!-- nav area  -->
        <?php require_once("partials/navbar.php"); ?>
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
          

          <div class="col">
              <p>Hello! <?php echo $customer["cust_firstname"] ?> we hope you are having a good day   (not <?php echo $customer["cust_firstname"] ?>?) <a href="logout.php" class="logoutbtn" >Logout</a></p>
              <p>From your account dashboard you can view recent orders, manage shipping and billing addresses, and edit your password and account details.</p>
              
          </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php") ?>
</body>
</html>