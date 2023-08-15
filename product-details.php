<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php

    include "header.php";

    if (isset($_GET["id"])) {

        $pid = $_GET["id"];

        $product_rs = Database::search("SELECT product.price,product.qty,product.category_id,product.brand_has_model_id,product.colour_id,product.description,product.title,product.condition_id,product.status_id,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,model.name AS mname,brand.name AS bname FROM `product` INNER JOIN `brand_has_model` ON brand_has_model.id = product.brand_has_model_id INNER JOIN `brand` ON brand.id = brand_has_model.brand_id INNER JOIN `model` ON model.id=brand_has_model.model_id WHERE product.id = '" . $pid . "' ");

        $product_num = $product_rs->num_rows;

        if ($product_num == 1) {

            $product_data = $product_rs->fetch_assoc();

    ?>

            <title><?php echo $product_data["title"]; ?> - AlphaTech</title>

            <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/png">

            <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
            <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">

            <!-- Main CSS -->
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/myStyle.css">

</head>

<body class="main-dark">

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php

                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product_data["category_id"] . "' ");
                        $category_data = $category_rs->fetch_assoc();

                        ?>
                        <h3 class="breadcrumb-title"><?php echo $category_data["name"]; ?> - <?php echo $product_data["title"]; ?></h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--white breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">Shop</a></li>
                                    <li class="active" aria-current="page"><?php echo $product_data["title"]; ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <div id="mainSearchResult">

        <!-- Start Product Details Section -->
        <div class="product-details-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                            <!-- Start Large Image -->

                            <?php

                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "' ");
                            $image_num = $image_rs->num_rows;
                            $img = array();

                            if ($image_num != 0) {

                                $image_rs2 = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "' ");
                                $image_num2 = $image_rs2->num_rows;

                            ?>

                                <div class="product-large-image product-large-image-horaizontal swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php

                                        for ($x = 0; $x < $image_num2; $x++) {

                                            $image_data2 = $image_rs2->fetch_assoc();
                                            $img[$x] = $image_data2["code"];

                                        ?>

                                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive2">
                                                <img src="<?php echo $img[$x]; ?>" alt="">
                                            </div>

                                        <?php

                                        }

                                        ?>
                                    </div>
                                </div>
                                <!-- End Large Image -->
                                <!-- Start Thumbnail Image -->
                                <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                                    <div class="swiper-wrapper">
                                        <?php

                                        $image_rs3 = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "' ");
                                        $image_num3 = $image_rs3->num_rows;

                                        for ($y = 0; $y < $image_num3; $y++) {

                                            $image_data3 = $image_rs3->fetch_assoc();
                                            $img[$y] = $image_data3["code"];

                                        ?>

                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid" src="<?php echo $img[$y]; ?>" alt="">
                                            </div>

                                        <?php

                                        }
                                        ?>

                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="gallery-thumb-arrow swiper-button-next"></div>
                                    <div class="gallery-thumb-arrow swiper-button-prev"></div>
                                </div>
                                <!-- End Thumbnail Image -->
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="product-details-content-area product-color--pink" data-aos="fade-up" data-aos-delay="200">
                            <!-- Start  Product Details Text Area-->
                            <div class="product-details-text">
                                <h3 class="title"><?php echo $product_data["title"]; ?></h3>
                                <div class="d-flex align-items-center">
                                    <ul class="review-star">
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="empty"><i class="ion-android-star"></i></li>
                                    </ul>
                                    <a href="#" class="customer-review ml-2">(4.5 Stars)</a>
                                </div>
                                <div class="price">Rs.<?php echo $product_data["price"]; ?>.00</div>
                                <div class="row">
                                    <div class="col-12 warrenty">Warrenty : <span>6 Months Warrenty</span></div>
                                    <div class="col-12 warrenty">Return Policy : <span>1 Months Return Policy</span></div>

                                </div>
                            </div> <!-- End  Product Details Text Area-->
                            <!-- Start Product Variable Area -->
                            <div class="product-details-variable pDetails">
                                <?php
                                $pqty = $product_data["qty"];

                                if ($pqty != 0) {

                                ?>
                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item">
                                        <div class="product-stock"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> <?php echo $pqty; ?> IN STOCK</div>
                                    </div>
                                    <!-- Product Variable Single Item -->
                                    <div class="pDetails-variable">
                                        <div class="variable-single-item pDetails-input">
                                            <span>Quantity</span>
                                            <div class="product-quantity">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <input value="1" type="text" pattern="[0-9]" id="qty_input" onkeyup='checkValue(<?php echo $pqty; ?>);'>
                                                        <span class="input-group-text input-btn1" id="minusBtn" onclick="qty_dec()"><i class="fa fa-minus" id="e3"></i></span>
                                                        <span class="input-group-text input-btn2" id="plusBtn" onclick='qty_inc(<?php echo $pqty; ?>)'><i class="fa fa-plus" id="e3"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-pink mb--35" type="submit" id="payhere-payment" onclick='payNow(<?php echo $pid; ?>);'>Buy now</a>
                                    </div>
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="pDetails-button2 mt-2">
                                        <a class="icon-space-right pl-0" onclick="addToWishlist(<?php echo $pid; ?>);"><i class="icon-heart"></i>Add to
                                            wishlist</a>
                                        <a class="icon-space-right" onclick="addToCart(<?php echo $pid; ?>);"><i class="icon-handbag"></i>Add to
                                            cart</a>
                                    </div> <!-- End  Product Details Meta Area-->

                                <?php
                                } else {
                                ?>

                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item">
                                        <div class="product-stock text-danger"> <span class="product-stock-out"><i class="ion-close-circled"></i></span> <?php echo $pqty; ?> IN STOCK</div>
                                    </div>
                                    <!-- Product Variable Single Item -->
                                    <div class="pDetails-variable">
                                        <div class="variable-single-item pDetails-input">
                                            <span>Quantity</span>
                                            <div class="product-quantity">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <input value="0" type="text" disabled>
                                                        <span class="input-group-text input-btn1 disabled"><i class="fa fa-minus" id="e3"></i></span>
                                                        <span class="input-group-text input-btn2 disabled"><i class="fa fa-plus" id="e3"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-pink mb--35 disabled">Buy now</a>
                                    </div>
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="pDetails-button2 mt-2">
                                        <a class="icon-space-right disabled pl-0"><i class="icon-heart"></i>Add to
                                            wishlist</a>
                                        <a class="icon-space-right disabled"><i class="icon-handbag"></i>Add to
                                            cart</a>
                                    </div> <!-- End  Product Details Meta Area-->

                                <?php
                                }
                                ?>
                            </div> <!-- End Product Variable Area -->

                            <!-- Start  Product Details Catagory Area-->
                            <div class="product-details-catagory mb-2">
                                <span class="title">CATEGORY:</span>
                                <ul>
                                    <li><a href="#"><?php echo $category_data["name"]; ?></a></li>
                                </ul>
                            </div> <!-- End  Product Details Catagory Area-->
                            <!-- Start  Product Details Brand Area-->
                            <div class="product-details-catagory mb-2">
                                <span class="title">BRAND:</span>
                                <ul>
                                    <li><a href="#"><?php echo $product_data["bname"]; ?></a></li>
                                </ul>
                            </div> <!-- End  Product Details Brand Area-->
                            <!-- Start  Product Details Social Area-->
                            <div class="product-details-social">
                                <span class="title">SHARE THIS PRODUCT:</span>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div> <!-- End  Product Details Social Area-->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Product Details Section -->

        <!-- Start Product Content Tab Section -->
        <div class="product-details-content-tab-section section-top-gap-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                            <!-- Start Product Details Tab Button -->
                            <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                                <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                        Description
                                    </a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#specification">
                                        Specification
                                    </a></li>
                                <?php

                                $review_rs = Database::search("SELECT user.fname, user.lname, profile_image.code, review.review, review.date FROM `review` INNER JOIN `product` ON review.product_id = product.id INNER JOIN `profile_image` ON review.user_email = profile_image.user_email INNER JOIN `user` ON review.user_email = user.email WHERE product.id = '" . $pid . "' ");
                                $review_num = $review_rs->num_rows;

                                ?>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#review">
                                        Reviews (<?php echo $review_num ?>)
                                    </a></li>
                            </ul> <!-- End Product Details Tab Button -->

                            <!-- Start Product Details Tab Content -->
                            <div class="product-details-content-tab">
                                <div class="tab-content">
                                    <!-- Start Product Details Tab Content Singel -->
                                    <div class="tab-pane active show" id="description">
                                        <div class="single-tab-content-item">
                                            <p><?php echo $product_data["description"]; ?></p>
                                        </div>
                                    </div> <!-- End Product Details Tab Content Singel -->
                                    <!-- Start Product Details Tab Content Singel -->
                                    <div class="tab-pane" id="specification">
                                        <div class="single-tab-content-item">
                                            <table class="table table-bordered mb-20">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Model</th>
                                                        <td><?php echo $product_data["mname"]; ?></td>
                                                    <tr>
                                                        <?php
                                                        $colour_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                                                        $colour_data = $colour_rs->fetch_assoc();
                                                        ?>
                                                        <th scope="row">Colour</th>
                                                        <td><?php echo $colour_data["name"]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                                                        $condition_data = $condition_rs->fetch_assoc();

                                                        if ($condition_data["name"] == "New") {
                                                            $conditon = "Brand new";
                                                        } else {
                                                            $conditon = "Second hand";
                                                        }
                                                        ?>
                                                        <th scope="row">Condition</th>
                                                        <td><?php echo $conditon; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Delivery fee Colombo</th>
                                                        <td>Rs.<?php echo $product_data["delivery_fee_colombo"]; ?>.00</td>
                                                    <tr>
                                                    <tr>
                                                        <th scope="row">Delivery fee out of Colombo</th>
                                                        <td>Rs.<?php echo $product_data["delivery_fee_other"]; ?>.00</td>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- End Product Details Tab Content Singel -->
                                    <!-- Start Product Details Tab Content Singel -->
                                    <div class="tab-pane" id="review">
                                        <div class="single-tab-content-item">
                                            <!-- Start - Review Comment -->
                                            <ul class="comment">
                                                <?php

                                                if ($review_num != 0) {

                                                    for ($x = 0; $x < $review_num; $x++) {
                                                        $review_data = $review_rs->fetch_assoc();
                                                ?>

                                                        <!-- Start - Review Comment list-->
                                                        <li class="comment-list">
                                                            <div class="comment-content-right">
                                                                <?php
                                                                $reviewData = $review_data["date"];
                                                                $rdatetime = explode(" ", $reviewData);
                                                                $rdate = $rdatetime[0];
                                                                ?>
                                                                <span class="date"><?php echo $rdate; ?></span>
                                                            </div>
                                                            <div class="comment-wrapper">
                                                                <div class="comment-img">
                                                                    <img src="<?php echo $review_data["code"]; ?>" alt="">
                                                                </div>
                                                                <div class="comment-content">
                                                                    <div class="comment-content-top">
                                                                        <div class="comment-content-left">

                                                                            <h6 class="comment-name"><?php echo $review_data["fname"] . " " . $review_data["lname"]; ?></h6>
                                                                            <ul class="review-star">
                                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                                </li>
                                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                                </li>
                                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                                </li>
                                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                                </li>
                                                                                <li class="empty"><i class="ion-android-star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="para-content">
                                                                        <p><?php echo $review_data["review"]; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li> <!-- End - Review Comment list-->
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <div class="empty-comment-content">
                                                        <img src="assets/images/empty/no-result.png" alt="">
                                                        <h3>This product has no reviews.</h3>
                                                    </div>

                                                <?php

                                                }
                                                ?>
                                            </ul> <!-- End - Review Comment -->
                                        </div>
                                    </div> <!-- End Product Details Tab Content Singel -->
                                </div>
                            </div> <!-- End Product Details Tab Content -->

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Product Content Tab Section -->

        <!-- Start Product Default Slider Section -->
        <div class="product-default-slider-section section-top-gap-100 section-fluid">
            <!-- Start Section Content Text Area -->
            <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-content-gap">
                                <div class="secton-content">
                                    <h3 class="section-title">RELATED PRODUCTS</h3>
                                    <p>Browse the collection of our related products.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Section Content Text Area -->
            <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-slider-default-1row default-slider-nav-arrow">
                                <!-- Slider main container -->
                                <div class="swiper-container product-default-slider-4grid-1row">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <?php

                                        $related_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $product_data["category_id"] . "' AND `id` <> '" . $pid . "' AND product.status_id = '1' LIMIT 6 OFFSET 0");
                                        $related_num = $related_rs->num_rows;

                                        for ($x = 0; $x < $related_num; $x++) {

                                            $related_data = $related_rs->fetch_assoc();

                                        ?>
                                            <!-- Start Product Default Single Item -->
                                            <div class="product-default-single-item product-color--pink swiper-slide">
                                                <div class="image-box">
                                                    <a href="product-details.php?id=<?php echo $related_data['id']; ?>" class="image-link">
                                                        <?php

                                                        $image2_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $related_data["id"] . "' ");
                                                        $image2_num = $image2_rs->num_rows;
                                                        $img = array();

                                                        for ($y = 0; $y < $image2_num; $y++) {

                                                            $image2_data = $image2_rs->fetch_assoc();

                                                            $img[$y] = $image2_data["code"];
                                                        }
                                                        ?>
                                                        <img src="<?php echo $img[0]; ?>" alt="">
                                                        <img src="<?php echo $img[1]; ?>" alt="">
                                                    </a>
                                                    <div class="action-link">
                                                        <div class="action-link-left">
                                                            <a onclick="addToCart(<?php echo $related_data['id']; ?>);">Add to Cart</a>
                                                        </div>
                                                        <div class="action-link-right">
                                                            <a onclick="quickModelView(<?php echo $related_data['id']; ?>);"><i class="icon-magnifier"></i></a>
                                                            <a onclick="addToWishlist(<?php echo $related_data['id']; ?>);"><i class="icon-heart"></i></a>
                                                            <a href="product-details.php?id=<?php echo $related_data['id']; ?>"><i class="icon-size-fullscreen"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="content-left">
                                                        <h6 class="title"><a href="product-details.php?id=<?php echo $related_data['id']; ?>"><?php echo $related_data["title"]; ?></a></h6>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="content-right">
                                                        <span class="price">Rs.<?php echo $related_data["price"]; ?>.00</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- End Product Default Single Item -->

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Product Default Slider Section -->

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
    <span class="login-error">Sorry for the Inconvenience</span>
<?php
        }
    } else {
?>
<span class="login-error">Something went wrong</span>
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