<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

?>

<h4>Orders</h4>
<div class="table_page table-responsive">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $pageno = 0;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $query = "SELECT `invoice`.`invoice_id`, `product`.`title`, `product`.`id` AS ipid, `invoice`.`status`, `invoice`.`total`, `invoice`.`date`  FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE `user_email`= '" . $email . "' ORDER BY `invoice`.`date` DESC";

            $order_rs = Database::search($query);
            $order_num = $order_rs->num_rows;

            $results_per_page = 9;
            $number_of_pages = ceil($order_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {

                $selected_data = $selected_rs->fetch_assoc();

                $selectedDate = $selected_data["date"];
                $oDateTime = explode(' ', $selectedDate);
                $oDate = $oDateTime[0];

                $status = $selected_data["status"];

            ?>
                <tr>
                    <td><?php echo $selected_data["invoice_id"]; ?></td>
                    <td><?php echo $selected_data["title"]; ?></td>
                    <td><?php echo $oDate; ?></td>
                    <td>Rs.<?php echo $selected_data["total"]; ?>.00</td>

                    <?php
                    if ($status == 0) {
                    ?>
                        <td><span class="status">Confirm Order</span></td>
                    <?php
                    } else if ($status == 1) {
                    ?>
                        <td><span class="status">Packing</span></td>
                    <?php
                    } else if ($status == 2) {
                    ?>
                        <td><span class="status">Dispatch</span></td>
                    <?php
                    } else if ($status == 3) {
                    ?>
                        <td><span class="status">Shipping</span></td>
                        <?php
                    } else if ($status == 4) {

                        $review_rs = Database::search("SELECT * FROM `review` WHERE `user_email`= '" . $email . "' AND `product_id` = '" . $selected_data["ipid"] . "'");
                        $review_num = $review_rs->num_rows;

                        if ($review_num == 0) {
                        ?>

                            <td><a class="reviewBtn" id="reviewText<?php echo $selected_data['ipid'] ?>" onclick="addReview(<?php echo $selected_data['ipid'] ?>);">Review</a></td>

                        <?php
                        } else {

                        ?>
                            <td><a class="text-white">Reviewed</a></td>
                    <?php
                        }
                    }

                    ?>
                </tr>

            <?php
            }
            ?>
        </tbody>

    </table>
</div>
<!-- Start Pagination -->
<div class="page-pagination text-center">
    <ul>
        <li>
            <a <?php if ($pageno <= 1) {
                    echo "#";
                } else {
                ?> onclick="myOrderResult('<?php echo ($pageno - 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipbackward"></i>
            </a>
        </li>
        <?php

        for ($x = 1; $x <= $number_of_pages; $x++) {
            if ($x == $pageno) {
        ?>

                <li>
                    <a class="active" onclick="myOrderResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

            <?php
            } else {
            ?>

                <li>
                    <a onclick="myOrderResult('<?php echo ($x); ?>');"><?php echo $x; ?></a>
                </li>

        <?php
            }
        }

        ?>

        <li>
            <a <?php if ($pageno >= $number_of_pages) {
                    echo "#";
                } else {
                ?> onclick="myOrderResult('<?php echo ($pageno + 1); ?>');" <?php } ?>>
                <i class="ion-ios-skipforward"></i>
            </a>
        </li>
    </ul>
</div> <!-- End Pagination -->