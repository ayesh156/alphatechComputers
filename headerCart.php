<?php

session_start();
require "connection.php";

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
$cart_num = $cart_rs->num_rows;

?>

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