<?php

require "connection.php";

$id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "'");

$product_data = $product_rs->fetch_assoc();

?>

<!-- Start Modal Add cart -->
<div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" onclick="acm.hide();">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 modal-add-cart-product-img-area">
                            <div class="modal-add-cart-product-img">
                                <?php
                                $image_rs2 = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $id . "' ");
                                $image_data2 = $image_rs2->fetch_assoc();

                                ?>
                                <img class="img-fluid" src="<?php echo $image_data2["code"]; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <!-- Start  Product Details Text Area-->
                            <div class="modal-add-text">
                                <h3 class="title"><?php echo $product_data["title"]; ?></h3>
                            </div> <!-- End  Product Details Text Area-->
                            <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart
                                successfully!</div>
                            <div class="modal-add-cart-product-cart-buttons">
                                <a href="cart.php" class="btn btn-pink">View Cart</a>
                                <a href="wishlist.php" class="btn btn-pink">View Wishlist</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Add cart -->