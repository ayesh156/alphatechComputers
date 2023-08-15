<!-- Start Wishlist Table -->
<div class="wishlish-table-wrapper">
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

                                require "connection.php";
                                session_start();

                                $email = $_SESSION["u"]["email"];

                                $pageno = 0;

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $query = "SELECT * FROM `watchlist` WHERE `user_email` = '" . $email . "'";

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
<div class="page-pagination text-center">
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