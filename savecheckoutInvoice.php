<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $o_id = $_POST["o"];
    $details = $_POST["det"];
    $discount = $_POST["dct"];
    $mail = $_SESSION["u"]["email"];

    $obj = json_decode($details);

    $ids = $obj -> id_array;
    $qty_array = $obj -> qty_array;
    $price_array = $obj -> price_array;

    $i_count = count($ids);

    for ($x = 0; $x < $i_count; $x++) {

        $in_id = uniqid();

        $p_id = $ids[$x];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $p_id . "' ");
        $product_data = $product_rs->fetch_assoc();

        $curr_qty = $product_data["qty"];
        $qty = $qty_array[$x];
        $new_qty = $curr_qty - $qty;
        $price = $price_array[$x];

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "' ");
        $address_data = $address_rs->fetch_assoc();

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
        $city_data = $city_rs->fetch_assoc();

        $delivery = 0;
        if ($city_data["district_id"] == 1) {
            $delivery = $product_data["delivery_fee_colombo"];
        } else {
            $delivery = $product_data["delivery_fee_other"];
        }

        $amount = $price + $delivery;

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $p_id . "' ");

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `invoice` (`invoice_id`,`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) VALUES ('".$o_id."','" . $in_id . "','" . $date . "','" . $amount . "','" .  $qty . "','0','" . $p_id . "','" . $mail . "')");

        Database::iud("DELETE FROM `cart` WHERE `product_id` = '" . $p_id . "' AND `user_email` = '".$mail."'");
    }

    echo ("1");
}
