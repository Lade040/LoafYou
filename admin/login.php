<?php
session_start();
error_reporting(E_ALL);
?>  
      
      
      <!-- Navbar Section -->
        <?php include("partials/navbar.php") ?> 
         <!-- Login section -->
        <div class="register row justify-content-center">
        <?php 
            if(isset($_SESSION["login_error"])){ 
            
            ?>

            <div class="col-8 justify-content-center alert alert-dark alert-dismissible fade show mt-4" role="alert">
            <p class="text-center, text-danger"><strong><?php echo $_SESSION["login_error"];?></strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <?php unset($_SESSION["login_error"]); ?>
                
           <?php } ?>
          <h4 class="text-center">Login</h4>
        
          <div class="col-8">
            <form action="process/login_process.php" method="post" >
              <label for="email" class="label-control">Email</label>
              <input type="email" id="email" name="admin_email" class="form-control">

              <label for="password" class="label-control">Password</label>
              <input type="password" id="password" name="admin_password" class="form-control"><span><i class="fa-solid fa-eye-slash" id="seepass"></i></span>
              <a href="#" class="forgot">Forgot Password</a>
                  

              <div class="d-grid gap-2 col-6 mx-auto">
                <input type="submit" name="login_btn" id="reg_btn" value="Login"  class="btn btn-large btn-dark mt-5 mb-5 reg-btn" >
              </div>
            </form> 
          </div>
        </div> 
            
        
        
  </div>
  <!-- footer -->
  <?php include("partials/footer.php") ?>
  <script src="assets/js/jquery.js"></script>
  <script>
    $(document).ready(function(){
      $("#seepass").click(function(){
        var state=$("#password").attr("type");
        if(state == "password"){
          $("#password").attr("type", "text");
        }else{
          $("#password").attr("type","password");
        };
      })
      
    })
  </script>
</body>
</html>