<?php

require "../connection.php";

$keyword = $_GET["k"];

if(!empty($keyword)) {
    $order_rs = Database::search("SELECT `invoice`.`id`,`invoice`.`invoice_id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`qty`,`invoice`.`total`,`invoice`.`status` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` WHERE `invoice`.`id` LIKE '%" . $keyword . "%' OR `invoice`.`invoice_id` LIKE '%" . $keyword . "%' OR `product`.`title` LIKE '%" . $keyword . "%' OR `invoice`.`id` LIKE '%" . $keyword . "%' OR `user`.`fname` LIKE '%" . $keyword . "%' OR `user`.`lname`LIKE '%" . $keyword . "%' ORDER BY `invoice`.`status` ASC");
}else {
    $order_rs = Database::search("SELECT `invoice`.`id`,`invoice`.`invoice_id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`qty`,`invoice`.`total`,`invoice`.`status` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email` = `user`.`email` INNER JOIN `product` ON `invoice`.`product_id` = `product`.`id` ORDER BY `invoice`.`status` ASC");
}

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
  ?>