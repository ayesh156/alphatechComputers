<?php

require "../connection.php";

if (!empty($_POST["f"]) || !empty($_POST["t"])) {

    $from_date = $_POST["f"];
    $to_date = $_POST["t"];

    $htmlfrom_Date  = strtotime($from_date);
    $from = date('Y-m-d', $htmlfrom_Date);

    $htmlto_Date  = strtotime($to_date);
    $to = date('Y-m-d', $htmlto_Date);

    $order_rs = Database::search("SELECT `invoice`.`id`,`invoice`.`invoice_id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`qty`,`invoice`.`total`,`invoice`.`status`,`invoice`.`date` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` ORDER BY `invoice`.`status` ASC");
    $order_num = $order_rs->num_rows;

    for ($x = 0; $x < $order_num; $x++) {

        $order_data = $order_rs->fetch_assoc();

        $sold_date = $order_data["date"];
        $date = explode(" ", $sold_date);

        $d = $date[0];
        $t = $date[1];

        if (!empty($from) && empty($to)) {
            if ($from <= $d) {
?>
                <tr>
                    <td><?php echo $order_data["id"]; ?></td>
                    <td><?php echo $order_data["invoice_id"]; ?></td>
                    <td class="tm-product-name"><?php echo $order_data["title"]; ?></td>
                    <td><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></td>
                    <td class="text-center"><?php echo $order_data["qty"]; ?></td>
                    <td>Rs.<?php echo $order_data["total"]; ?>.00</td>
                    <td>
                        <?php
                        if ($order_data["status"] == 0) {
                        ?>
                            <button class="confirm-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Confirm Order</button>
                        <?php
                        } else if ($order_data["status"] == 1) {
                        ?>
                            <button class="packing-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Packing</button>
                        <?php
                        } else if ($order_data["status"] == 2) {
                        ?>
                            <button class="dispatch-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Dispatch</button>
                        <?php
                        } else if ($order_data["status"] == 3) {
                        ?>
                            <button class="shipping-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Shipping</button>
                        <?php
                        } else if ($order_data["status"] == 4) {
                        ?>
                            <button class="delivered-btn disabled" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Delivered</button>
                        <?php
                        }

                        ?>
                    </td>
                </tr>
            <?php
            }
        } else if (empty($from) && !empty($to)) {
            if ($to >= $d) {
            ?>
                <tr>
                    <td><?php echo $order_data["id"]; ?></td>
                    <td><?php echo $order_data["invoice_id"]; ?></td>
                    <td class="tm-product-name"><?php echo $order_data["title"]; ?></td>
                    <td><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></td>
                    <td class="text-center"><?php echo $order_data["qty"]; ?></td>
                    <td>Rs.<?php echo $order_data["total"]; ?>.00</td>
                    <td>
                        <?php
                        if ($order_data["status"] == 0) {
                        ?>
                            <button class="confirm-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Confirm Order</button>
                        <?php
                        } else if ($order_data["status"] == 1) {
                        ?>
                            <button class="packing-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Packing</button>
                        <?php
                        } else if ($order_data["status"] == 2) {
                        ?>
                            <button class="dispatch-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Dispatch</button>
                        <?php
                        } else if ($order_data["status"] == 3) {
                        ?>
                            <button class="shipping-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Shipping</button>
                        <?php
                        } else if ($order_data["status"] == 4) {
                        ?>
                            <button class="delivered-btn disabled" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Delivered</button>
                        <?php
                        }

                        ?>
                    </td>
                </tr>
            <?php
            }
        } else if (!empty($from) && !empty($to)) {
            if ($from <= $d && $to >= $d) {
            ?>
                <tr>
                    <td><?php echo $order_data["id"]; ?></td>
                    <td><?php echo $order_data["invoice_id"]; ?></td>
                    <td class="tm-product-name"><?php echo $order_data["title"]; ?></td>
                    <td><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></td>
                    <td class="text-center"><?php echo $order_data["qty"]; ?></td>
                    <td>Rs.<?php echo $order_data["total"]; ?>.00</td>
                    <td>
                        <?php
                        if ($order_data["status"] == 0) {
                        ?>
                            <button class="confirm-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Confirm Order</button>
                        <?php
                        } else if ($order_data["status"] == 1) {
                        ?>
                            <button class="packing-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Packing</button>
                        <?php
                        } else if ($order_data["status"] == 2) {
                        ?>
                            <button class="dispatch-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Dispatch</button>
                        <?php
                        } else if ($order_data["status"] == 3) {
                        ?>
                            <button class="shipping-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Shipping</button>
                        <?php
                        } else if ($order_data["status"] == 4) {
                        ?>
                            <button class="delivered-btn disabled" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Delivered</button>
                        <?php
                        }

                        ?>
                    </td>
                </tr>
        <?php
            }
        }
    }
} else {

    $order_rs = Database::search("SELECT `invoice`.`id`,`invoice`.`invoice_id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`qty`,`invoice`.`total`,`invoice`.`status` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` ORDER BY `invoice`.`status` ASC");
    $order_num = $order_rs->num_rows;

    for ($x = 0; $x < $order_num; $x++) {

        $order_data = $order_rs->fetch_assoc();

        ?>
        <tr>
            <td><?php echo $order_data["id"]; ?></td>
            <td><?php echo $order_data["invoice_id"]; ?></td>
            <td class="tm-product-name"><?php echo $order_data["title"]; ?></td>
            <td><?php echo $order_data["fname"] . " " . $order_data["lname"]; ?></td>
            <td class="text-center"><?php echo $order_data["qty"]; ?></td>
            <td>Rs.<?php echo $order_data["total"]; ?>.00</td>
            <td>
                <?php
                if ($order_data["status"] == 0) {
                ?>
                    <button class="confirm-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Confirm Order</button>
                <?php
                } else if ($order_data["status"] == 1) {
                ?>
                    <button class="packing-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Packing</button>
                <?php
                } else if ($order_data["status"] == 2) {
                ?>
                    <button class="dispatch-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Dispatch</button>
                <?php
                } else if ($order_data["status"] == 3) {
                ?>
                    <button class="shipping-btn" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Shipping</button>
                <?php
                } else if ($order_data["status"] == 4) {
                ?>
                    <button class="delivered-btn disabled" onclick="changeStatus('<?php echo $order_data['id']; ?>')" id="btn<?php echo $order_data["id"]; ?>">Delivered</button>
                <?php
                }

                ?>
            </td>
        </tr>
<?php
    }
}

?>