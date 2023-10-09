<?php
session_start();
require("Classes/State.php");
$state1= new State();
$states=$state1->fetch_states();
?>  
      
      
      <!-- Navbar Section -->
        <?php include("Partials/navbar.php") ?> 
         <!-- Login or register section -->
         <div class="row register justify-content-center mt-5" id="regform">
            <div class="col-8 mt-5">
                <h4 class="text-center mt-5 mb-4" id="top">New here? Register</h4>
                <p>Registered? <a href="login.php" id="log_btn" class="btn loginprompt">Login</a></p>
                <!-- error alert shows here -->
                <?php 
              if(isset($_SESSION["reg_error"])){ 
              
              ?>
              <div class="col-12 ms-2 alert alert-secondary alert-dismissible fade show" role="alert">
              <p class="text-center, text-danger"><strong><?php echo $_SESSION["reg_error"];?></strong></p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              
              <?php unset($_SESSION["reg_error"]); ?>
                  
            <?php } ?>
            <!-- registration form starts here -->
              <form action="process/register_process.php" method="post" class="reg-form">
                <!-- <p>*All fields are required in order to serve you well</p> -->
              
                
                <input type="text" id="fname" name="cust_firstname" class="form-control" placeholder="First Name">

                <input type="text" id="lname" name="cust_lastname" class="form-control" placeholder="Last Name">

                <input type="text" id="phone" name="cust_phone" class="form-control" placeholder="Phone">

                <input type="email" id="email" name="cust_email" class="form-control" placeholder="Email">

                <span>Gender</span>
                <label for="genderF">Female</label><input type="radio" name="cust_gender" id="genderF" value="Female" class="form-check-input">
                <label for="genderM">Male</label><input type="radio" name="cust_gender" id="genderM" value="Male" class="form-check-input">

                <label for="dob" class="label-control"></label>
                <input type="date" name="cust_dob" id="dob" class="form-control" placeholder="Birthday">

                <input type="password" id="pass" name="cust_password" class="form-control" placeholder="Password">

                <input type="password" id="cpass" name="confirmpassword" class="form-control" placeholder="Confirm Password">

                <input type="text" name="cust_address" id="address" class="form-control" placeholder="Address">

                <select name="cust_state" id="stateid" class="form-control">
                  <option value="">Select a state</option>
                  <?php
                    foreach($states as $state1){
                  ?>
                    <option value="<?php echo $state1["state_id"]; ?>"><?php echo $state1["state_name"]; ?></option>
                  <?php 
                    }
                  ?>
                </select>

                <select name="cust_lga" id="lga" class="form-control">
                  <option value="">Select a local government</option>
                </select>
                

                <div class="d-grid gap-2 col-6 mx-auto">
                  <input type="submit" name="reg_btn" id="reg_btn" value="Register" class="btn btn-large btn-dark mt-5 mb-5 reg-btn">
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
      $("#stateid").change(function(){
                var stateid=$(this).val();
                // alert(stateid);

                $("#lga").load("process/lga_process.php", {"stateid":stateid}, function(response,status, xhr){
                    console.log(response);
                });
      })

    })
  </script>
</body>
</html>