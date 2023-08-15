<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body>

    <?php

    session_start();
    require "connection.php";

    ?>
    <!-- Start Header Area -->
    <header class="header-section d-none d-xl-block">
        <div class="header-wrapper">
            <div class="header-bottom header-bottom-color--black section-fluid sticky-header sticky-color--black">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <!-- Start Header Logo -->
                            <div class="header-logo">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/images/logo/header_logo.png" alt=""></a>
                                </div>
                            </div>
                            <!-- End Header Logo -->

                            <!-- Start Header Main Menu -->
                            <div class="main-menu menu-color--white menu-hover-color--golden">
                                <nav>
                                    <ul>
                                        <li>
                                            <a class="active main-menu-link" href="index.php">Home</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Shop</a>
                                        </li>
                                        <li>
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li>
                                            <a href="contact-us.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- End Header Main Menu Start -->

                            <?php

                            if (!isset($_SESSION["u"])) {

                            ?>

                                <div class="main-menu menu-color--white menu-hover-color--golden">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="login.php">Login / Register</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            <?php


                            }

                            ?>

                            <!-- Start Header Action Link -->
                            <ul class="header-action-link action-color--white action-hover-color--golden">
                                <?php

                                if (isset($_SESSION["u"])) {

                                ?>
                                    <li>
                                        <a href="my-account.php">
                                            <i class="icon-user"></i>
                                        </a>
                                    </li>

                                <?php



                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                    $watchlist_num = $watchlist_rs->num_rows;

                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                    $cart_num = $cart_rs->num_rows;
                                } else {

                                    $watchlist_num = 0;
                                    $cart_num = 0;
                                }

                                ?>

                                <li>
                                    <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                        <i class="icon-heart"></i>
                                        <span class="item-count" id="wishlistCount1"><?php echo $watchlist_num; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                        <i class="icon-bag"></i>
                                        <span class="item-count" id="cartCount1"><?php echo $cart_num; ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#search">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                        <i class="icon-menu"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Header Action Link -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Start Header Area -->

    <!-- Start Mobile Header -->
    <div class="mobile-header  mobile-header-bg-color--black section-fluid d-lg-block d-xl-none">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <!-- Start Mobile Left Side -->
                    <div class="mobile-header-left">
                        <ul class="mobile-menu-logo">
                            <li>
                                <a href="index.php">
                                    <div class="logo">
                                        <img src="assets/images/logo/header_logo.png" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Left Side -->

                    <!-- Start Mobile Right Side -->
                    <div class="mobile-right-side">
                        <ul class="header-action-link action-color--white action-hover-color--golden">
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart"></i>
                                    <span class="item-count" id="wishlistCount2"><?php echo $watchlist_num; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span class="item-count" id="cartCount2"><?php echo $cart_num; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu offside-menu-color--black">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Right Side -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Header -->

    <!--  Start Offcanvas Mobile Menu Section -->
    <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu  -->
            <div class="mobile-menu-bottom">
                <!-- Start Mobile Menu Nav -->
                <div class="offcanvas-menu">
                    <ul>
                        <li>
                            <a class="active main-menu-link" href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="shop.php">Shop</a>
                        </li>
                        <li>
                            <a href="about-us.php">About Us</a>
                        </li>
                        <li>
                            <a href="contact-us.php">Contact Us</a>
                        </li>

                        <?php

                        if (isset($_SESSION["u"])) {

                        ?>
                            <li>
                                <a href="my-account.php">My Account</a>
                            </li>

                        <?php


                        } else {

                        ?>

                            <li>
                                <a href="login.php">Login / Register</a>
                            </li>

                        <?php

                        }

                        ?>

                    </ul>
                </div> <!-- End Mobile Menu Nav -->
            </div> <!-- End Mobile Menu -->

            <!-- Start Mobile contact Info -->
            <div class="mobile-contact-info">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/logo/header_logo.png" alt=""></a>
                </div>

                <address class="address">
                    <span>Address: Maradana, Colombo 10.</span>
                    <span>Call Us: 0112 445557</span>
                    <span>Email: alphaTech@gmail.com</span>
                </address>

                <ul class="social-link">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>

                <ul class="user-link">
                    <li><a href="wishlist.php">Wishlist</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
            <!-- End Mobile contact Info -->

        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
                <a href="index.php"><img src="assets/images/logo/header_logo.png" alt=""></a>
            </div>

            <address class="address">
                <span>Address: Maradana, Colombo 10.</span>
                <span>Call Us: 0112 445557</span>
                <span>Email: alphaTech@gmail.com</span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Addcart Section -->
    <div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section bg-dark">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->

        <!-- Start  Offcanvas Addcart Wrapper -->
        <div class="offcanvas-add-cart-wrapper">
            <h3 class="offcanvas-title">Shopping Cart</h3>
            <div id="headerCart">
                <ul class="offcanvas-cart">
                    <?php
                    if ($cart_num != 0) {
                        $cartTotal = 0;
                        for ($y = 0; $y < $cart_num; $y++) {

                            $cart_data = $cart_rs->fetch_assoc();

                    ?>
                            <li class="offcanvas-cart-item-single">
                                <div class="offcanvas-cart-item-block">
                                    <a href="#" class="offcanvas-cart-item-image-link">
                                        <?php

                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $cart_data["product_id"] . "'");
                                        $product_img_num = $product_img_rs->num_rows;

                                        if ($product_img_num = 0) {
                                        ?>

                                            <img src="assets/images/empty/empty-product.png" alt="" class="offcanvas-cart-image">

                                        <?php
                                        } else {

                                            $product_img_data  = $product_img_rs->fetch_assoc();

                                        ?>
                                            <img src="<?php echo $product_img_data["code"] ?>" alt="" class="offcanvas-cart-image">

                                        <?php
                                        }

                                        ?>

                                    </a>
                                    <div class="offcanvas-cart-item-content">
                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_data["product_id"] . "'");
                                        $product_data  = $product_rs->fetch_assoc();

                                        $cartTotal = $cartTotal + ($cart_data["qty"] * $product_data["price"]);

                                        ?>
                                        <a href="#" class="offcanvas-cart-item-link"><?php echo $product_data["title"] ?></a>
                                        <div class="offcanvas-cart-item-details">
                                            <span class="offcanvas-cart-item-details-quantity"><?php echo $cart_data["qty"] ?> x </span>
                                            <span class="offcanvas-cart-item-details-price">Rs.<?php echo $product_data["price"] ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="offcanvas-cart-item-delete text-right">
                                    <a href="#" class="offcanvas-cart-item-delete" onclick="deleteCartItem(<?php echo $cart_data['product_id'] ?>);"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </li>

                        <?php

                        }

                        ?>
                </ul>
                <div class="offcanvas-cart-total-price">
                    <span class="offcanvas-cart-total-price-text">Subtotal:</span>
                    <span class="offcanvas-cart-total-price-value">Rs.<?php echo $cartTotal ?>.00</span>
                </div>
                <ul class="offcanvas-cart-action-button">
                    <li><a href="cart.php" class="btn btn-block btn-pink">View Cart</a></li>
                </ul>
            <?php
                    } else {
            ?>
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="headerAC-content text-center">
                        <div class="image">
                            <img class="img-fluid" src="assets/images/emprt-cart/empty-cart.png" alt="">
                        </div>
                        <h5 class="title">Your Cart is Empty</h5>
                        <h6 class="sub-title">Sorry Mate... No item Found inside your cart!</h6>
                        <a href="shop.php" class="btn btn-lg btn-pink">Continue Shopping</a>
                    </div>
                </div>
            <?php
                    }
            ?>
            </div>
        </div> <!-- End  Offcanvas Addcart Wrapper -->

    </div> <!-- End  Offcanvas Addcart Section -->

    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section bg-dark">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h3 class="offcanvas-title">Wishlist</h3>
            <div id="headerWishlist">
                <ul class="offcanvas-wishlist">
                    <?php
                    if ($watchlist_num != 0) {

                        for ($x = 0; $x < $watchlist_num; $x++) {

                            $watchlist_data = $watchlist_rs->fetch_assoc();

                    ?>
                            <li class="offcanvas-wishlist-item-single">
                                <div class="offcanvas-wishlist-item-block">
                                    <a href="#" class="offcanvas-wishlist-item-image-link">
                                        <?php

                                        $product_img_rs2 = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $watchlist_data["product_id"] . "'");
                                        $product_img_num2 = $product_img_rs2->num_rows;

                                        if ($product_img_num2 = 0) {
                                        ?>

                                            <img src="assets/images/empty/empty-product.png" alt="" class="offcanvas-cart-image">

                                        <?php

                                        } else {

                                            $product_img_data2  = $product_img_rs2->fetch_assoc();

                                        ?>
                                            <img src="<?php echo $product_img_data2["code"] ?>" alt="" class="offcanvas-wishlist-image">

                                        <?php
                                        }

                                        ?>

                                    </a>
                                    <div class="offcanvas-wishlist-item-content">
                                        <?php

                                        $product_rs2 = Database::search("SELECT * FROM `product` WHERE `id` = '" . $watchlist_data["product_id"] . "'");
                                        $product_data2  = $product_rs2->fetch_assoc();

                                        ?>
                                        <a href="#" class="offcanvas-wishlist-item-link"><?php echo $product_data2["title"] ?></a>
                                        <div class="offcanvas-wishlist-item-details">
                                            <span class="offcanvas-wishlist-item-details-price">Rs.<?php echo $product_data2["price"] ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="offcanvas-wishlist-item-delete text-right">
                                    <a href="#" class="offcanvas-wishlist-item-delete" onclick="deleteWishlistItem(<?php echo $watchlist_data['product_id'] ?>);"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </li>

                        <?php
                        }
                        ?>
                </ul>
                <ul class="offcanvas-wishlist-action-button">
                    <li><a href="wishlist.php" class="btn btn-block btn-pink">View wishlist</a></li>
                </ul>
            <?php
                    } else {

            ?>
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="headerAC-content text-center">
                        <div class="image">
                            <img class="img-fluid" src="assets/images/emprt-cart/empty-cart.png" alt="">
                        </div>
                        <h5 class="title">Your Wishlist is Empty</h5>
                        <h6 class="sub-title">Sorry Mate... No item Found inside your wishlist!</h6>
                        <a href="shop.php" class="btn btn-lg btn-pink">Continue Shopping</a>
                    </div>
                </div>
            <?php
                    }
            ?>
            </div> <!-- End Offcanvas Mobile Menu Wrapper -->

        </div>

    </div> <!-- End Offcanvas Mobile Menu Section -->

    <!-- Start Offcanvas Search Bar Section -->
    <div id="search" class="search-modal">
        <button type="button" class="close">×</button>
        <input type="search" id="searchInput" placeholder="type keyword(s) here" />
        <button onclick="mainSearch();" class="btn btn-lg btn-pink">Search</button>
    </div>
    <!-- End Offcanvas Search Bar Section -->

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>