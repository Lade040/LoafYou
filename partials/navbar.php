<!DOCTYPE html>
<html lang="en">
<head>
    <title>LoafYou</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
    <body class="padding-top">
      <div class="container-fluid">
        <!-- Navbar Section -->
        <div class="row" >
               <div class="col">
                  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" >
                    <div class="container-fluid px-0">
                      <a class="navbar-brand ps-5" href="../index.php">Loaf <i class="fa-solid fa-heart"></i> You</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse justify-content-end pe-4 custom-navbar" id="navbarSupportedContent">
                        <ul class="navbar-nav  mb-2 mb-lg-0 ">
                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                          </li>
                          <li class="nav-item">
                            <form action="search.php" method="get" class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass" name="search_btn"></i></button>
                            </form>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="userprofile.php"><i class="fa-solid fa-user"></i></a>
                          </li>
                          <li class="nav-item">
                            <button class="btn" href="cart.php" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" ><i class="fa-solid fa-cart-shopping"></i><span id="cartcount" class="text-bg-secondary position-absolute px-2 rounded-circle"><?php if(isset($_SESSION["cart"])){
                              echo count($_SESSION["cart"]);
                            }else{
                              echo 0;
                            } ?></span></button>

                          </li>
                        </ul>
                        
                      </div>
                    </div>
                  </nav>
                  <!-- Cart offcanvas -->
                  <div class="row">
                    <div class="col-12">
                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1"      id="offcanvasWithBothOptions"       aria-labelledby="offcanvas">
                      <div class="offcanvas-header">
                          <h5 class="offcanvas-title text-center" id="offcanvas">Shopping Cart</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <div class="row justify-content-around mt-5">
                            <div class="row mt-5 mb-5">
                              <div class="col mx-auto">
                                  <a href="cart.php" class="btn btn-lg  btn-outline-secondary mb-2 col-12">View Cart</a>
                                    <a href="checkout.php" class="btn btn-lg   mb-2 col-12 proimage btn-outline-secondary">Checkout</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
          </div>
    </div> 