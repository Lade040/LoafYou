<?php
session_start();
error_reporting(E_ALL);
include("Classes/State.php");
$state1= new State();
$states=$state1->fetch_states();
?>  
      
      
      <!-- Navbar Section -->
        <?php include("Partials/navbar.php") ?> 
         <!-- Login or register section -->
        <div class="row justify-content-center loginform" id="loginform">
          <h4 class="text-center" id="top">Login</h4>
          <?php 
            if(isset($_SESSION["login_error"])){ 
            
            ?>
            
            <div class="col-8 justify-content-center alert alert-dark alert-dismissible fade show" role="alert">
            <p class="text-center, text-danger"><strong><?php echo $_SESSION["login_error"];?></strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <?php unset($_SESSION["login_error"]); ?>
                
           <?php } ?>
          <div class="col-8" >
            <form action="process/login_process.php" method="post" id="loginform">
              <label for="email" class="label-control ">Email</label>
              <input type="email" id="email" name="cust_email" class="form-control">

              <label for="password" class="label-control">Password</label>
              <div class="d-flex">
                  <input type="password" id="password" name="cust_password" class="form-control"><i class="fa-solid fa-eye-slash pt-3" id="seepass"></i>
              </div>
              
              <a href="#">Forgot Password?</a>
              <p>New here? <a href="register.php" id="regbtn" class="loginprompt btn btn-sm">Register</a></p>
                   

              <div class="d-grid gap-2 col-6 mx-auto">
                <input type="submit" name="login_btn" id="login" value="Login" class="btn btn-large btn-dark mb-5 reg-btn" >
              </div>
              </form>
          </div>
          <div class="text-end">
                <a href="#top" class="text-secondary"><i class="fa-solid fa-arrow-turn-up fa-flip-horizontal"></i>Back to top</a>
            </div>
          </div>
    
            
        <!-- footer -->
        <?php include("partials/footer.php") ?>
  </div>
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