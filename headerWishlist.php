<?php

session_start();
require "connection.php";

$watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
$watchlist_num = $watchlist_rs->num_rows;

?>

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
            <h5 class="title">Your Cart is Wishlist</h5>
            <h6 class="sub-title">Sorry Mate... No item Found inside your wishlist!</h6>
            <a href="shop.php" class="btn btn-lg btn-pink">Continue Shopping</a>
        </div>
    </div>
<?php
    }
?>