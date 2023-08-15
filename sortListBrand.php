<?php

require "connection.php";

$search = $_POST["s"];
$sort = $_POST["st"];
$category = $_POST["c"];

$query = "SELECT * FROM `product` INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id WHERE brand_has_model.brand_id = '" . $search . "' AND status_id = '1'";

if ($category != 0) {
    $query .= " AND category_id = '" . $category . "'";
}

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
                ?> onclick="sortListBrand('<?php echo $search; ?>','<?php echo ($pageno - 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipbackward"></i>
            </a>
        </li>
        <?php

        for ($v = 1; $v <= $number_of_pages; $v++) {
            if ($v == $pageno) {
        ?>

                <li>
                    <a class="active" onclick="sortListBrand('<?php echo $search; ?>','<?php echo ($v); ?>');"><?php echo $v; ?></a>
                </li>

            <?php
            } else {
            ?>

                <li>
                    <a onclick="sortListBrand('<?php echo $search; ?>','<?php echo ($v); ?>');"><?php echo $v; ?></a>
                </li>

        <?php
            }
        }

        ?>

        <li>
            <a <?php if ($pageno >= $number_of_pages) {
                    echo "#";
                } else {
                ?> onclick="sortListBrand('<?php echo $search; ?>','<?php echo ($pageno + 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipforward"></i>
            </a>
        </li>
    </ul>
</div> <!-- End Pagination -->