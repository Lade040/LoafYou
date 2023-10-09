<?php 
  session_start();
  include_once("guards/admin_guard.php") 

?>
        <!-- Navbar Section -->
        <?php 
          require_once("partials/navbar.php");
        ?>
        
        <!-- User Profile Section -->
        
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2>Admin</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <?php require_once("partials/dash_navigation.php"); ?>
          

          <div class="col">
             <p class="adminintro mt-5">Hi Admin! View everything about your website here. You can add and delete product categories and products, and also see more information about each product. </p>
             <p>You can keep track of your orders and customers also! </p>
          </div>
          <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php");?>
</body>
</html>