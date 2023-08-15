<?php

require "connection.php";

$id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "'");

$product_data = $product_rs->fetch_assoc();

?>

<!-- Start Modal Quickview -->
<div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" onclick="qvm.hide();">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-details-gallery-area mb-7">

                                <?php

                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $id . "' ");
                                $image_num = $image_rs->num_rows;
                                $img = array();

                                if ($image_num != 0) {

                                    $image_rs2 = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $id . "' ");
                                    $image_data2 = $image_rs2->fetch_assoc();

                                ?>
                                    <!-- Start Large Image -->
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-image swiper-slide img-responsive">

                                            <img src="<?php echo $image_data2["code"]; ?>" id="main_img" alt="">
                                        </div>
                                    </div>
                                    <!-- End Large Image -->
                                    <!-- Start Thumbnail Image -->
                                    <div class="product-image-thumb modal-product-image-thumb pos-relative mt-5">
                                        <div class="row">
                                            <?php

                                            for ($x = 0; $x < $image_num; $x++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$x] = $image_data["code"];

                                            ?>
                                                <div class="product-image-thumb-single">
                                                    <img class="img-fluid" src="<?php echo $img[$x]; ?>" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>)" />
                                                </div>

                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                <?php
                                } else {
                                ?>

                                    <!-- Start Large Image -->
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="./assets/images/empty/empty-product.png" alt="">
                                        </div>
                                    </div>
                                    <!-- End Large Image -->
                                    <!-- Start Thumbnail Image -->
                                    <div class="product-image-thumb modal-product-image-thumb pos-relative mt-5">
                                        <div class="row">
                                            <div class="product-image-thumb-single">
                                                <img class="img-fluid" src="./assets/images/empty/empty-product.png" />
                                            </div>
                                            <div class="product-image-thumb-single">
                                                <img class="img-fluid" src="./assets/images/empty/empty-product.png" />
                                            </div>
                                            <div class="product-image-thumb-single">
                                                <img class="img-fluid" src="./assets/images/empty/empty-product.png" />
                                            </div>
                                            <div class="product-image-thumb-single">
                                                <img class="img-fluid" src="./assets/images/empty/empty-product.png" />
                                            </div>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                            <!-- End Thumbnail Image -->
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-details-content-area">
                                <!-- Start  Product Details Text Area-->
                                <div class="product-details-text">
                                    <h3 class="title"><?php echo $product_data["title"]; ?></h3>
                                    <ul class="review-star">
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                        <li class="empty"><i class="ion-android-star"></i></li>
                                    </ul>
                                    <div class="price">Rs.<?php echo $product_data["price"]; ?>.00</div>
                                </div> <!-- End  Product Details Text Area-->
                                <!-- Start Product Variable Area -->
                                <div class="product-details-variable pDetails">
                                    <?php

                                    $pqty = $product_data["qty"];

                                    if ($pqty != 0) {
                                    ?>
                                        <div class="available"><span>Availablity :</span> <?php echo $pqty; ?> Items</div>
                                        <!-- Product Variable Single Item -->
                                        <div class="pDetails-variable">
                                            <div class="variable-single-item pDetails-input">
                                                <span>Quantity</span>
                                                <div class="product-quantity pDetails-qty">
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <input value="1" type="text" pattern="[0-9]" id="qty_input" onkeyup='checkValue(<?php echo $pqty; ?>);'>
                                                            <span class="input-group-text input-btn1" id="minusBtn" onclick="qty_dec()"><i class="fa fa-minus" id="e3"></i></span>
                                                            <span class="input-group-text input-btn2" id="plusBtn" onclick='qty_inc(<?php echo $pqty; ?>)'><i class="fa fa-plus" id="e3"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-pink mb--2" type="submit" id="payhere-payment" onclick='payNow(<?php echo $id; ?>);'>Buy now</a>
                                        </div>
                                        <!-- Start  Product Details Meta Area-->
                                        <div class="pDetails-button mt-1">
                                            <a class="icon-space-right" onclick="addToWishlist(<?php echo $id; ?>);"><i class="icon-heart"></i>Add to
                                                wishlist</a>
                                            <a class="icon-space-right" onclick="addToCart(<?php echo $id; ?>);"><i class="icon-handbag"></i>Add to
                                                cart</a>
                                        </div> <!-- End  Product Details Meta Area-->
                                    <?php
                                    } else {
                                    ?>
                                        <div class="available text-danger"><span>Availablity :</span> <?php echo $pqty; ?> Items</div>
                                        <!-- Product Variable Single Item -->
                                        <div class="pDetails-variable">
                                            <div class="variable-single-item pDetails-input">
                                                <span>Quantity</span>
                                                <div class="product-quantity pDetails-qty">
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <input value="0" type="text" disabled>
                                                            <span class="input-group-text input-btn1 disabled"><i class="fa fa-minus" id="e3"></i></span>
                                                            <span class="input-group-text input-btn2 disabled"><i class="fa fa-plus" id="e3"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-pink mb--2 disabled">Buy now</a>
                                        </div>
                                        <!-- Start  Product Details Meta Area-->
                                        <div class="pDetails-button mt-1">
                                            <a class="icon-space-right disabled"><i class="icon-heart"></i>Add to
                                                wishlist</a>
                                            <a class="icon-space-right disabled"><i class="icon-handbag"></i>Add to
                                                cart</a>
                                        </div> <!-- End  Product Details Meta Area-->
                                    <?php
                                    }
                                    ?>

                                </div> <!-- End Product Variable Area -->
                            </div> <!-- End Product Variable Area -->
                            <div class="modal-product-about-text">

                                <?php

                                $string = $product_data["description"];

                                $limitText = mb_strimwidth($string, 0, 105, "...");

                                ?>
                                <p><?php echo $limitText; ?></p>
                            </div>
                            <!-- Start  Product Details Social Area-->
                            <div class="modal-product-details-social">
                                <span class="title">SHARE THIS PRODUCT</span>
                                <ul>
                                    <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="whatsapp"><i class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="#" class="telegram"><i class="fa fa-telegram"></i></a>
                                    </li>
                                    <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>

                            </div> <!-- End  Product Details Social Area-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- End Modal Quickview -->