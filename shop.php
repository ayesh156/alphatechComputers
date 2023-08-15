<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Shop - AlphaTech</title>

    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <?php include "header.php"; ?>

    <div id="mainSearchResult">

        <!-- ...:::: Start Breadcrumb Section:::... -->
        <div class="breadcrumb-section breadcrumb-bg-color--golden">
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="breadcrumb-title">Shop</h3>
                            <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                                <nav aria-label="breadcrumb">
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li class="active" aria-current="page">Shop</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Breadcrumb Section:::... -->

        <!-- ...:::: Start Shop Section:::... -->
        <div class="shop-section">
            <div class="container">
                <div class="row flex-column-reverse flex-lg-row">
                    <div class="col-lg-3">
                        <!-- Start Sidebar Area -->
                        <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                            <!-- Start Single Sidebar Widget -->
                            <div class="sidebar-single-widget">
                                <h6 class="sidebar-title">CATEGORIES</h6>
                                <div class="sidebar-content">
                                    <ul class="sidebar-menu">
                                        <?php

                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;

                                        ?>
                                        <div class="d-none" id="categoryCount"><?php echo $category_num; ?></div>
                                        <?php

                                        for ($r = 0; $r < $category_num; $r++) {

                                            $category_data = $category_rs->fetch_assoc();

                                        ?>

                                            <li><a class="tag" id="categoryId<?php echo $category_data['id']; ?>" onclick="sortGridCategory(<?php echo $category_data['id']; ?>,0); sortListCategory(<?php echo $category_data['id']; ?>,0);"><?php echo $category_data["name"]; ?></a></li>

                                        <?php
                                        }

                                        ?>
                                    </ul>
                                </div>
                            </div> <!-- End Single Sidebar Widget -->

                            <!-- Start Single Sidebar Widget -->
                            <div class="sidebar-single-widget">
                                <h6 class="sidebar-title">SELECT BY MANUFACTURER</h6>
                                <div class="sidebar-content">
                                    <div class="filter-type-select">
                                        <ul>
                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($y = 0; $y < $brand_num; $y++) {

                                                $brand_data = $brand_rs->fetch_assoc();

                                            ?>
                                                <li>
                                                    <label class="checkbox-default" for="brand<?php echo $y ?>" onclick="sortGridBrand(<?php echo $brand_data['id']; ?>,0); sortListBrand(<?php echo $brand_data['id']; ?>,0);">
                                                        <input type="radio" name="brand" id="brand<?php echo $y ?>">
                                                        <span><?php echo $brand_data["name"]; ?></span>
                                                    </label>
                                                </li>

                                            <?php
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End Single Sidebar Widget -->

                            <!-- Start Single Sidebar Widget -->
                            <div class="sidebar-single-widget">
                                <h6 class="sidebar-title">SELECT BY CONDITION</h6>
                                <div class="sidebar-content">
                                    <div class="filter-type-select">
                                        <ul>
                                            <?php

                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($z = 0; $z < $condition_num; $z++) {

                                                $condition_data = $condition_rs->fetch_assoc();

                                                if ($condition_data["name"] == "New") {
                                                    $condition = "Brand new";
                                                } else {
                                                    $condition = "Second hand";
                                                }

                                            ?>
                                                <li>
                                                    <label class="checkbox-default" for="con<?php echo $z ?>" onclick="sortGridCondition(<?php echo $condition_data['id']; ?>,0); sortListCondition(<?php echo $condition_data['id']; ?>,0);">
                                                        <input type="radio" name="condition" id="con<?php echo $z ?>">
                                                        <span><?php echo $condition; ?></span>
                                                    </label>
                                                </li>

                                            <?php
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End Single Sidebar Widget -->

                            <!-- Start Single Sidebar Widget -->
                            <div class="sidebar-single-widget">
                                <h6 class="sidebar-title">SELECT BY COLOUR</h6>
                                <div class="sidebar-content">
                                    <div class="filter-type-select">
                                        <ul>
                                            <?php

                                            $colour_rs = Database::search("SELECT * FROM `colour`");
                                            $colour_num = $colour_rs->num_rows;

                                            for ($c = 0; $c < $colour_num; $c++) {

                                                $colour_data = $colour_rs->fetch_assoc();


                                            ?>


                                                <li>
                                                    <label class="checkbox-default" for="clr<?php echo $c ?>" onclick="sortGridColour(<?php echo $colour_data['id']; ?>,0); sortListColour(<?php echo $colour_data['id']; ?>,0);">
                                                        <input type="radio" name="colour" id="clr<?php echo $c ?>">
                                                        <span><?php echo $colour_data["name"]; ?></span>
                                                    </label>
                                                </li>

                                            <?php
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- End Single Sidebar Widget -->
                        </div> <!-- End Sidebar Area -->
                    </div>
                    <div class="col-lg-9">
                        <!-- Start Shop Product Sorting Section -->
                        <div class="shop-sort-section">
                            <div class="container">
                                <div class="row">
                                    <!-- Start Sort Wrapper Box -->
                                    <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up" data-aos-delay="0">
                                        <!-- Start Sort tab Button -->
                                        <div class="sort-tablist d-flex align-items-center">
                                            <ul class="tablist nav sort-tab-btn">
                                                <li><a class="nav-link active" onclick="document.getElementById('pAmount').innerHTML = 'Showing 9 results';" data-bs-toggle="tab" href="#layout-3-grid"><img src="assets/images/icons/bkg_grid.png" alt=""></a></li>
                                                <li><a class="nav-link" onclick="document.getElementById('pAmount').innerHTML = 'Showing 4 results';" data-bs-toggle="tab" href="#layout-list"><img src="assets/images/icons/bkg_list.png" alt=""></a></li>
                                            </ul>

                                            <!-- Start Page Amount -->
                                            <div class="page-amount ml-2">
                                                <span id="pAmount">Showing 9 results</span>
                                            </div> <!-- End Page Amount -->
                                        </div> <!-- End Sort tab Button -->

                                        <!-- Start Sort Select Option -->
                                        <div class="sort-select-list d-flex align-items-center">
                                            <label class="mr-2">Sort By:</label>
                                            <fieldset>
                                                <select name="speed" id="speed">
                                                    <option value="1">Sort by quantity: low to high</option>
                                                    <option value="2">Sort by quantity: high to low</option>
                                                    <option value="3" selected>Sort by newness</option>
                                                    <option value="4">Sort by price: low to high</option>
                                                    <option value="5">Sort by price: high to low</option>
                                                </select>
                                            </fieldset>
                                        </div> <!-- End Sort Select Option -->
                                    </div> <!-- Start Sort Wrapper Box -->
                                </div>
                            </div>
                        </div> <!-- End Section Content -->

                        <!-- Start Tab Wrapper -->
                        <div class="sort-product-tab-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content tab-animate-zoom">
                                            <!-- Start Grid View Product -->
                                            <div class="tab-pane active show sort-layout-single" id="layout-3-grid" data-aos="fade-up" data-aos-delay="200">
                                                <div class="row" id="productGridView">
                                                    <?php

                                                    $pageno = 0;

                                                    if (isset($_GET["page"])) {
                                                        $pageno = $_GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $query = "SELECT * FROM `product` WHERE status_id = '1' AND category_id = '1'";

                                                    $product_rs = Database::search($query);
                                                    $product_num = $product_rs->num_rows;

                                                    $results_per_page = 9;
                                                    $number_of_pages = ceil($product_num / $results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;
                                                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                                    $selected_num = $selected_rs->num_rows;

                                                    for ($x = 0; $x < $selected_num; $x++) {
                                                        $selected_data = $selected_rs->fetch_assoc();

                                                    ?>
                                                        <div class="col-xl-4 col-sm-6 col-12">

                                                            <!-- Start Product Default Single Item -->
                                                            <div class="product-default-single-item product-color--pink swiper-slide">
                                                                <div class="image-box">
                                                                    <a href="product-details.php?id=<?php echo $selected_data['id']; ?>" class="image-link">
                                                                        <?php

                                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["id"] . "' ");
                                                                        $image_num = $image_rs->num_rows;
                                                                        $img = array();

                                                                        for ($y = 0; $y < $image_num; $y++) {

                                                                            $image_data = $image_rs->fetch_assoc();

                                                                            $img[$y] = $image_data["code"];
                                                                        }
                                                                        ?>
                                                                        <img src="<?php echo $img[0]; ?>" alt="">
                                                                        <img src="<?php echo $img[1]; ?>" alt="">
                                                                    </a>
                                                                    <?php

                                                                    if ($selected_data["qty"] != 0) {

                                                                    ?>
                                                                        <div class="action-link">
                                                                            <div class="action-link-left">
                                                                                <a onclick="addToCart(<?php echo $selected_data['id']; ?>);">Add to Cart</a>
                                                                            </div>
                                                                            <div class="action-link-right">
                                                                                <a onclick="quickModelView(<?php echo $selected_data['id']; ?>);"><i class="icon-magnifier"></i></a>
                                                                                <a onclick="addToWishlist(<?php echo $selected_data['id']; ?>);"><i class="icon-heart"></i></a>
                                                                                <a href="product-details.php?id=<?php echo $selected_data['id']; ?>"><i class="icon-size-fullscreen"></i></a>
                                                                            </div>
                                                                        </div>

                                                                    <?php
                                                                    } else {

                                                                    ?>
                                                                        <div class="action-link">
                                                                            <div class="action-link-left">
                                                                                <a class="disabled text-danger">Add to Cart</a>
                                                                            </div>
                                                                            <div class="action-link-right">
                                                                                <a onclick="quickModelView(<?php echo $selected_data['id']; ?>);"><i class="icon-magnifier"></i></a>
                                                                                <a class="disabled text-danger"><i class="icon-heart"></i></a>
                                                                                <a href="product-details.php?id=<?php echo $selected_data['id']; ?>"><i class="icon-size-fullscreen"></i></a>
                                                                            </div>
                                                                        </div>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="content">
                                                                    <div class="content-left">
                                                                        <h6 class="title"><a href="product-details.php?id=<?php echo $selected_data['id']; ?>"><?php echo $selected_data["title"]; ?></a></h6>
                                                                        <ul class="review-star">
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="content-right">
                                                                        <span class="price">Rs.<?php echo $selected_data["price"]; ?>.00</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- End Product Default Single Item -->


                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <!-- Start Pagination -->
                                                    <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                                        <ul>
                                                            <li>
                                                                <a <?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?> onclick="productGridView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                                                                    <i class="ion-ios-skipbackward"></i>
                                                                </a>
                                                            </li>
                                                            <?php

                                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                                if ($x == $pageno) {
                                                            ?>

                                                                    <li>
                                                                        <a class="active" onclick="productGridView('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                                    </li>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <li>
                                                                        <a onclick="productGridView('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                                    </li>

                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                            <li>
                                                                <a <?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?> onclick="productGridView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                                                                    <i class="ion-ios-skipforward"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div> <!-- End Pagination -->
                                                </div>
                                            </div> <!-- End Grid View Product -->

                                            <!-- Start List View Product -->
                                            <div class="tab-pane sort-layout-single" id="layout-list">
                                                <div class="row" id="productListView">
                                                    <?php

                                                    $pageno = 0;

                                                    if (isset($_GET["page"])) {
                                                        $pageno = $_GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $query = "SELECT * FROM `product` WHERE status_id = '1' AND category_id = '1'";

                                                    $product2_rs = Database::search($query);
                                                    $product2_num = $product2_rs->num_rows;

                                                    $results_per_page = 4;
                                                    $number_of_pages = ceil($product2_num / $results_per_page);

                                                    $page_results = ($pageno - 1) * $results_per_page;
                                                    $selected2_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                                    $selected2_num = $selected2_rs->num_rows;

                                                    for ($v = 0; $v < $selected2_num; $v++) {
                                                        $selected2_data = $selected2_rs->fetch_assoc();



                                                    ?>
                                                        <div class="col-12">
                                                            <!-- Start Product Defautlt Single -->
                                                            <div class="product-list-single product-color--pink">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4">
                                                                        <a href="product-details.php?id=<?php echo $selected2_data['id']; ?>" class="product-list-img-link">
                                                                            <?php

                                                                            $image2_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected2_data["id"] . "' ");
                                                                            $image2_num = $image2_rs->num_rows;
                                                                            $img = array();

                                                                            for ($y = 0; $y < $image2_num; $y++) {

                                                                                $image2_data = $image2_rs->fetch_assoc();

                                                                                $img[$y] = $image2_data["code"];
                                                                            }
                                                                            ?>
                                                                            <img class="img-fluid" src="<?php echo $img[0]; ?>" alt="">
                                                                            <img class="img-fluid" src="<?php echo $img[1]; ?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-12 col-md-8">
                                                                        <div class="product-list-content">
                                                                            <h5 class="product-list-link"><a href="product-details.php?id=<?php echo $selected2_data['id']; ?>"><?php echo $selected2_data["title"]; ?></a></h5>
                                                                            <ul class="review-star">
                                                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                                            </ul>
                                                                            <span class="product-list-price">Rs.<?php echo $selected2_data["price"]; ?>.00</span>
                                                                            <p><?php echo $selected2_data["description"]; ?></p>

                                                                            <?php

                                                                            if ($selected2_data["qty"] != 0) {

                                                                            ?>
                                                                                <div class="product-action-icon-link-list">
                                                                                    <a onclick="addToCart(<?php echo $selected2_data['id']; ?>);" class="btn btn-lg btn-pink-default-hover">Add to
                                                                                        cart</a>
                                                                                    <a onclick="quickModelView(<?php echo $selected2_data['id']; ?>);" class="btn btn-lg btn-pink-default-hover"><i class="icon-magnifier"></i></a>
                                                                                    <a onclick="addToWishlist(<?php echo $selected2_data['id']; ?>);" class="btn btn-lg btn-pink-default-hover"><i class="icon-heart"></i></a>
                                                                                    <a href="product-details.php?id=<?php echo $selected2_data['id']; ?>" class="btn btn-lg btn-pink-default-hover"><i class="icon-size-fullscreen"></i></a>
                                                                                </div>

                                                                            <?php
                                                                            } else {

                                                                            ?>
                                                                                <div class="product-action-icon-link-list">
                                                                                    <a class="btn btn-lg  btn-pink-default-hover bg-danger disabled">Add to
                                                                                        cart</a>
                                                                                    <a onclick="quickModelView(<?php echo $selected2_data['id']; ?>);" class="btn btn-lg btn-pink-default-hover"><i class="icon-magnifier"></i></a>
                                                                                    <a class="btn btn-lg btn-pink-default-hover bg-danger disabled"><i class="icon-heart"></i></a>
                                                                                    <a href="product-details.php?id=<?php echo $selected2_data['id']; ?>" class="btn btn-lg btn-pink-default-hover"><i class="icon-size-fullscreen"></i></a>
                                                                                </div>

                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- End Product Defautlt Single -->
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- Start Pagination -->
                                                    <div class="page-pagination text-center">
                                                        <ul>
                                                            <li>
                                                                <a <?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?> onclick="productListView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                                                                    <i class="ion-ios-skipbackward"></i>
                                                                </a>
                                                            </li>
                                                            <?php

                                                            for ($v = 1; $v <= $number_of_pages; $v++) {
                                                                if ($v == $pageno) {
                                                            ?>

                                                                    <li>
                                                                        <a class="active" onclick="productListView('<?php echo ($v); ?>');"><?php echo $v; ?></a>
                                                                    </li>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <li>
                                                                        <a onclick="productListView('<?php echo ($v); ?>');"><?php echo $v; ?></a>
                                                                    </li>

                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                            <li>
                                                                <a <?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?> onclick="productListView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                                                                    <i class="ion-ios-skipforward"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div> <!-- End Pagination -->
                                                </div>
                                            </div> <!-- End List View Product -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Tab Wrapper -->


                    </div>
                </div>
            </div>
        </div> <!-- ...:::: End Shop Section:::... -->

    </div>

    <?php include "footer.php"; ?>

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

    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>