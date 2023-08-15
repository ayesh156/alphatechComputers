<!-- Start Cart Table -->
<div class="cart-table-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table_desc">
                    <div class="table_page table-responsive">
                        <table>
                            <!-- Start Cart Table Head -->
                            <thead>
                                <tr>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                    <th class="product_remove"></th>
                                </tr>
                            </thead> <!-- End Cart Table Head -->
                            <tbody>
                                <!-- Start Cart Single Item-->
                                <?php

                                $pageno = 0;

                                $total = 0;
                                $shipping = 0;

                                $id_array;
                                $qty_array;
                                $title_array;
                                $price_array;

                                session_start();
                                require "connection.php";

                                $email = $_SESSION["u"]["email"];

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $query = "SELECT * FROM `cart` WHERE `user_email` = '" . $email . "'";

                                $cart_rs = Database::search($query);
                                $cart_num = $cart_rs->num_rows;

                                $results_per_page = 4;
                                $number_of_pages = ceil($cart_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {

                                    $selected_data = $selected_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $selected_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $price = $product_data["price"];
                                    $qty = $selected_data["qty"];
                                    $pid = $selected_data['product_id'];

                                    $product_total = ($price * $qty);


                                ?>
                                    <tr>

                                        <?php

                                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["product_id"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        if ($product_data["qty"] != 0) {

                                            $id_array[$x] = $product_data["id"];
                                            $title_array[$x] = $product_data["title"];
                                            $price_array[$x] = $product_data["price"];

                                            $total = $total + ($price * $qty);

                                            $address_rs = Database::search("SELECT district.id as did FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE `user_email`='" . $email . "' ");

                                            $address_data = $address_rs->fetch_assoc();

                                            $ship = 0;

                                            if ($address_data["did"] == 1) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                                $shipping = $shipping + $ship;
                                            } else {
                                                $ship = $product_data["delivery_fee_other"];
                                                $shipping = $shipping + $ship;
                                            }

                                        ?>
                                            <td class="product_thumb"><a href="product-details.php?id=<?php echo $pid; ?>"><img src="<?php echo $img_data["code"]; ?>" alt=""></a></td>
                                            <td class="product_name"><a href="product-details.php?id=<?php echo $pid; ?>"><?php echo $product_data["title"]; ?></a></td>
                                            <td class="product-price">Rs.<?php echo $price; ?>.00</td>
                                            <td class="product_quantity">
                                                <!-- Product Variable Single Item -->
                                                <div class="cDetails-input">
                                                    <div class="product-quantity">
                                                        <div class="row">
                                                            <span class="input-group-text input-btn3" id="minusBtn<?php echo $pid; ?>" onclick="cartQty_dec(<?php echo $pid; ?>,<?php echo $pageno; ?>)"><i class="fa fa-minus" id="e3"></i></span>
                                                            <input value="<?php echo $qty; ?>" type="text" pattern="[0-9]" id="qty_input<?php echo $pid; ?>" onkeyup='checkCartValue(<?php echo $product_data["qty"]; ?>,<?php echo $pid; ?>,<?php echo $pageno; ?>);'>
                                                            <?php
                                                            $qty_array[$x] = $qty;
                                                            ?>
                                                            <span class="input-group-text input-btn2" id="plusBtn<?php echo $pid; ?>" onclick='cartQty_inc(<?php echo $product_data["qty"]; ?>,<?php echo $pid; ?>,<?php echo $pageno; ?>)'><i class="fa fa-plus" id="e3"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product_total">Rs.<?php echo $product_total; ?>.00</td>
                                            <td class="product_remove"><a onclick="deleteCart(<?php echo $pid; ?>,<?php echo $pageno; ?>);"><i class="fa fa-trash-o"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <td class="product_thumb"><a href="product-details.php?id=<?php echo $pid; ?>"><img src="<?php echo $img_data["code"]; ?>" alt=""></a></td>
                                            <td class="product_name"><a href="product-details.php?id=<?php echo $pid; ?>"><?php echo $product_data["title"]; ?></a></td>
                                            <td class="product-price">Rs.<?php echo $price; ?>.00</td>
                                            <td class="product_quantity">
                                                <div class="cDetails-input">
                                                    <div class="product-quantity">
                                                        <div class="row">
                                                            <span class="input-group-text input-btn3 disabled"><i class="fa fa-minus" id="e3"></i></span>
                                                            <input value="0" type="text" disabled>
                                                            <span class="input-group-text input-btn2 disabled"><i class="fa fa-plus" id="e3"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product_total">Rs.<?php echo $product_total; ?>.00</td>
                                            <td class="product_remove"><a onclick="deleteCart(<?php echo $pid; ?>,<?php echo $pageno; ?>);"><i class="fa fa-trash-o"></i></a>
                                            <?php
                                        }
                                            ?>

                                    </tr> <!-- End Cart Single Item-->
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
</div> <!-- End Cart Table -->

<!-- Start Pagination -->
<div class="page-pagination text-center">
    <ul>
        <li>
            <a <?php if ($pageno <= 1) {
                    echo "#";
                } else {
                ?> onclick="cartSearchResult('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipbackward"></i>
            </a>
        </li>
        <?php

        for ($x = 1; $x <= $number_of_pages; $x++) {
            if ($x == $pageno) {
        ?>

                <li>
                    <a class="active" onclick="cartSearchResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

            <?php
            } else {
            ?>

                <li>
                    <a onclick="cartSearchResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

        <?php
            }
        }

        ?>

        <li>
            <a <?php if ($pageno >= $number_of_pages) {
                    echo "#";
                } else {
                ?> onclick="cartSearchResult('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipforward"></i>
            </a>
        </li>
    </ul>
</div> <!-- End Pagination -->

<!-- Start Coupon Start -->
<div class="coupon_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="coupon_code left">
                    <h3>Coupon</h3>
                    <div class="coupon_inner">
                        <p>Enter your coupon code if you have one.</p>
                        <div class="coupon-content">
                            <div class="coupon_input">
                                <input class="mb-2" placeholder="Coupon code" id="couponCode" type="text">
                                <button class="btn btn-md btn-pink mb-1" onclick="applyCoupon();">Apply coupon</button>
                            </div>
                            <span class="couponAlert" id="couponMsg">Coupon</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="coupon_code right">
                    <h3>Cart Totals</h3>
                    <div class="coupon_inner">
                        <div class="cart_subtotal">
                            <p>Subtotal ( <?php echo $selected_num; ?> items )</p>
                            <p class="cart_amount">Rs.<span id="subTotal"><?php echo $total ?></span>.00</p>
                        </div>
                        <div class="cart_subtotal ">
                            <p>Shipping</p>
                            <p class="cart_amount">Rs.<span id="shipping"><?php echo $shipping ?></span>.00</p>
                        </div>
                        <div class="cart_subtotal">
                            <p>Discount ( - )</p>
                            <p class="cart_amount">Rs.<span id="discount">0</span>.00</p>
                        </div>
                        <span class="hr"></span>
                        <div class="cart_subtotal">
                            <p>Total</p>
                            <?php
                            $grand_total = ($shipping + $total);
                            ?>
                            <p class="cart_amount">Rs.<span id="total"><?php echo $grand_total ?></span>.00</p>
                        </div>
                        <div class="checkout_btn">
                            <a type="submit" id="payhere-payment" onclick="checkout();" class="btn btn-md btn-pink">Proceed to Checkout</a>
                        </div>

                        <?php

                        $obj = new stdClass();

                        $obj->id_array = $id_array;
                        $obj->qty_array = $qty_array;
                        $obj->title_array = $title_array;
                        $obj->price_array = $price_array;
                        $obj->subtotal = $total;
                        $obj->shipping = $shipping;
                        $obj->total = $grand_total;

                        ?>

                        <div class="d-none" id="details"><?php echo json_encode($obj); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Coupon Start -->