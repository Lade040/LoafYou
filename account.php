<?php 
    session_start();
    error_reporting(E_ALL);
 
    include_once("guards/cust_guard.php");
    require_once("Classes/Customer.php");
    require("Classes/State.php");
    $state1= new State();
    $states=$state1->fetch_states();
 

  if(isset($_SESSION["cust_id"])){
    $cust_id= $_SESSION["cust_id"];
    $customer1= new Customer();
    $customer =$customer1->fetch_details($cust_id);
}
?>     
      <!-- code for updating customer info -->
      <!-- nav area  -->
        <?php require_once("partials/navbar.php"); ?>
        <!-- User Profile Section -->
        <!-- Banner -->
        <div class="row profileBanner pt-5">
            <div class="col text-center">
                <h2 class="pbold">My Account</h2>
            </div>
        </div>
        <!-- Dashboard Navigation -->
        <div class="row dashboard" >
            <?php require_once("partials/dashboard.php"); ?>
          

          <div class="col">
          <?php 
              if(isset($_SESSION["feedback"])){ 
              
              ?>
              <div class="col-12 ms-2 alert alert-secondary alert-dismissible fade show" role="alert">
              <p class="text-center, text-danger"><strong><?php echo $_SESSION["feedback"];?></strong></p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              
              <?php unset($_SESSION["feedback"]); ?>
                  
            <?php } ?>
              <h3 class="text-center">Update Account</h3>
              <!-- form starts here -->
              <form action="process/account_update_process.php" method="post" class="reg-form">
              
                <input type="text" id="fname" name="cust_firstname" class="form-control" placeholder="First Name" value="<?php echo $customer["cust_firstname"];?>">

                <input type="text" id="lname" name="cust_lastname" class="form-control" placeholder="Last Name"  value="<?php echo $customer["cust_lastname"];?>">

                <input type="text" id="phone" name="cust_phone" class="form-control" placeholder="Phone"  value="<?php echo $customer["cust_phone"];?>">

                <input type="email" id="email" name="cust_email" class="form-control" placeholder="Email" value="<?php echo $customer["cust_email"];?>">

                <span>Gender</span>
                <label for="genderF">Female</label><input type="radio" name="cust_gender" id="genderF" value="Female" class="form-check-input">
                <label for="genderM">Male</label><input type="radio" name="cust_gender" id="genderM" value="Male" class="form-check-input">

                <label for="dob" class="label-control"></label>
                <input type="date" max="2010-01-01" name="cust_dob" id="dob" class="form-control" placeholder="Birthday">

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
                <input type="hidden" value="<?php echo $_SESSION["cust_id"];?>" name="cust_id">

                <div class="d-grid gap-2 col-6 mx-auto">
                  <input type="submit" name="reg_btn" id="reg_btn" value="Update Account" class="btn btn-large btn-outline-dark mt-5 mb-5 proimage">
                </div>
                
              </form>
              <!-- form ends here -->
          </div>
        </div>
        <!-- footer -->
        <?php require_once("partials/footer.php") ?>
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