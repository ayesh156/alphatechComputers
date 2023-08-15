<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Wishlist - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <?php include "header.php";

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

    ?>

        <div id="mainSearchResult">
            <!-- ...:::: Start Breadcrumb Section:::... -->
            <div class="breadcrumb-section breadcrumb-bg-color--golden">
                <div class="breadcrumb-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="breadcrumb-title">Wishlist</h3>
                                <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                    <nav aria-label="breadcrumb">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li class="active" aria-current="page">Wishlist</li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- ...:::: End Breadcrumb Section:::... -->

            <?php

            $query = "SELECT * FROM `watchlist` WHERE `user_email` = '" . $email . "'";

            $wishlist_rs = Database::search($query);
            $wishlist_num = $wishlist_rs->num_rows;

            if ($wishlist_num != 0) {

            ?>

                <!-- ...:::: Start Wishlist Section:::... -->
                <div class="wishlist-section" id="wishlistSearchResult">

                    <!-- Start Wishlist Table -->
                    <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table_desc">
                                        <div class="table_page table-responsive">
                                            <table>
                                                <!-- Start Wishlist Table Head -->
                                                <thead>
                                                    <tr>
                                                        <th class="product_thumb">Image</th>
                                                        <th class="product_name">Product</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product_stock">Stock Status</th>
                                                        <th class="product_addcart">Add To Cart</th>
                                                        <th class="product_remove"></th>
                                                    </tr>
                                                </thead> <!-- End Wishlist Table Head -->
                                                <tbody>
                                                    <!-- Start Wishlist Single Item-->
                                                    <?php

                                                    $pageno = 0;

                                                    if (isset($_GET["page"])) {
                                                        $pageno = $_GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $wishlist_rs = Database::search($query);
                                                    $wishlist_num = $wishlist_rs->num_rows;

                                                    $results_per_page = 4;
                                                    $number_of_pages = ceil($wishlist_num / $results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;
                                                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                                    $selected_num = $selected_rs->num_rows;

                                                    for ($x = 0; $x < $selected_num; $x++) {

                                                        $selected_data = $selected_rs->fetch_assoc();

                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $selected_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $pid = $product_data["id"];
                                                        $pqty = $product_data["qty"];

                                                    ?>
                                                        <tr>

                                                            <?php

                                                            $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["product_id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                            <td class="product_thumb"><a href="product-details.php?id=<?php echo $pid; ?>"><img src="<?php echo $img_data["code"]; ?>" alt=""></a></td>
                                                            <td class="product_name"><a href="product-details.php?id=<?php echo $pid; ?>"><?php echo $product_data["title"]; ?></a></td>
                                                            <td class="product-price">Rs.<?php echo $product_data["price"]; ?>.00</td>
                                                            <?php

                                                            if ($pqty != 0) {
                                                            ?>
                                                                <td class="product_stock"><span>In Stock</span></td>
                                                                <td class="product_addcart"><a onclick="addToCart(<?php echo $pid; ?>);" class="btn btn-md btn-pink">Add To Cart</a></td>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <td class="product_stock"><span class="text-danger">Out of Stock</span></td>
                                                                <td class="product_addcart"><a class="btn btn-md btn-pink disabled">Add To Cart</a></td>
                                                            <?php
                                                            }
                                                            ?>

                                                            <td class="product_remove"><a onclick="deleteWishlist(<?php echo $pid; ?>,<?php echo $pageno; ?>);"><i class="fa fa-trash-o"></i></a>
                                                        </tr> <!-- End Wishlist Single Item-->
                                                    <?php

                                                    }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Wishlist Table -->

                    <!-- Start Pagination -->
                    <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                        <ul>
                            <li>
                                <a <?php if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                    ?> onclick="wishlistSearchResult('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                                    <i class="ion-ios-skipbackward"></i>
                                </a>
                            </li>
                            <?php

                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($x == $pageno) {
                            ?>

                                    <li>
                                        <a class="active" onclick="wishlistSearchResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                    </li>

                                <?php
                                } else {
                                ?>

                                    <li>
                                        <a onclick="wishlistSearchResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                    </li>

                            <?php
                                }
                            }

                            ?>

                            <li>
                                <a <?php if ($pageno >= $number_of_pages) {
                                        echo "#";
                                    } else {
                                    ?> onclick="wishlistSearchResult('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                                    <i class="ion-ios-skipforward"></i>
                                </a>
                            </li>
                        </ul>
                    </div> <!-- End Pagination -->
                </div> <!-- ...:::: End Wishlist Section:::... -->

            <?php

            } else {

            ?>
                <!-- ...::::Start Empty Wishlist Section:::... -->
                <div class="empty-cart-section section-fluid">
                    <div class="emptycart-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                                    <div class="emptycart-content text-center">
                                        <div class="image">
                                            <img class="img-fluid" src="assets/images/emprt-cart/empty-cart.png" alt="">
                                        </div>
                                        <h4 class="title">Your wishlist is Empty</h4>
                                        <h6 class="sub-title">Sorry Mate... No item Found inside your cart!</h6>
                                        <a href="shop.php" class="btn btn-lg btn-pink">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- ...::::End Empty Wishlist Section:::... -->

            <?php
            }

            ?>

        </div>

        <div id="quickModelView"></div>

        <div id="addModalcart"></div>

        <div id="addModalwishlist"></div>

        <!-- Start Modal Alert -->
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h1 class="text-warning" id="alertText"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid text-center">
                            <a class="btn btn-pink-default-hover btn-width" id="alertBtn">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Modal Alert -->

    <?php
    } else {
    ?>
        <span class="login-error">Please Login First</span>
    <?php
    }

    include "footer.php";

    ?>

    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>