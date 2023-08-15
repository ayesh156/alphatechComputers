<?php

require "connection.php";

$search = $_POST["s"];
$sort = $_POST["st"];
$category = $_POST["c"];
$brand = $_POST["b"];

$query = "SELECT * FROM `product`";

if ($category == 0 && $brand == 0) {
    $query .= " WHERE `condition_id`= '" . $search . "' ";
} else if ($category == 0 && $brand != 0) {
    $query .= " INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id WHERE brand_has_model.brand_id = '" . $brand . "'";
    $query .= " AND `condition_id`= '" . $search . "'";
} else if ($category != 0 && $brand == 0) {
    $query .= " WHERE `condition_id`= '" . $search . "' AND `category_id`='" . $category . "' ";
} else if ($category != 0 && $brand != 0) {
    $query .= " INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id WHERE brand_has_model.brand_id = '" . $brand . "' AND `condition_id`= '" . $search . "' AND `category_id`='" . $category . "' ";
}

$query .= " AND status_id = '1'";

if ($sort == '1') {
    $query .= " ORDER BY `qty` ASC";
} else if ($sort == '2') {
    $query .= " ORDER BY `qty` DESC";
} else if ($sort == '3') {
    $query .= " ORDER BY `datetime_added` ASC";
} else if ($sort == '4') {
    $query .= " ORDER BY `price` ASC";
} else if ($sort == '5') {
    $query .= " ORDER BY `price` DESC";
}

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

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
                ?> onclick="sortGridCondition('<?php echo $search; ?>','<?php echo ($pageno - 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipbackward"></i>
            </a>
        </li>
        <?php

        for ($x = 1; $x <= $number_of_pages; $x++) {
            if ($x == $pageno) {
        ?>

                <li>
                    <a class="active" onclick="sortGridCondition('<?php echo $search; ?>','<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

            <?php
            } else {
            ?>

                <li>
                    <a onclick="sortGridCondition('<?php echo $search; ?>','<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

        <?php
            }
        }

        ?>

        <li>
            <a <?php if ($pageno >= $number_of_pages) {
                    echo "#";
                } else {
                ?> onclick="sortGridCondition('<?php echo $search; ?>','<?php echo ($pageno + 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipforward"></i>
            </a>
        </li>
    </ul>
</div> <!-- End Pagination -->