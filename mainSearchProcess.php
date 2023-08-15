<?php

require "connection.php";
session_start();

?>

<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-12">

                <!-- Start Tab Wrapper -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content tab-animate-zoom">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid" data-aos="fade-up" data-aos-delay="200">
                                        <div class="row">
                                            <?php

                                            $search = $_GET["s"];

                                            $pageno = 0;

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            if (!empty($search)) {
                                                $query = "SELECT product.id AS id, price, qty, title FROM `product` INNER JOIN `category` ON product.category_id = category.id INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id INNER JOIN `brand` ON brand_has_model.brand_id = brand.id INNER JOIN `model` ON brand_has_model.model_id = model.id WHERE (`product`.`status_id` = '1') AND (title LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%' OR category.name LIKE '%" . $search . "%' OR brand.name LIKE '%" . $search . "%' OR model.name LIKE '%" . $search . "%') ";
                                            } else {
                                                $query = "SELECT * FROM `product` WHERE status_id = '1'";
                                            }

                                            $product_rs = Database::search($query);
                                            $product_num = $product_rs->num_rows;

                                            $results_per_page = 8;
                                            $number_of_pages = ceil($product_num / $results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;
                                            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                            $selected_num = $selected_rs->num_rows;

                                            for ($x = 0; $x < $selected_num; $x++) {
                                                $selected_data = $selected_rs->fetch_assoc();

                                            ?>
                                                <div class="col-sm-6 col-md-4 col-xl-3 col-12">

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
                                                                <a class="active" onclick="mainSearchView('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                            </li>

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <li>
                                                                <a onclick="mainSearchView('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                                                            </li>

                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                    <li>
                                                        <a <?php if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                            ?> onclick="mainSearchView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                                                            <i class="ion-ios-skipforward"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> <!-- End Pagination -->
                                        </div>
                                    </div> <!-- End Grid View Product -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->