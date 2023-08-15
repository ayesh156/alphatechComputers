<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $details = $_POST["dtl"];
    $discount = $_POST["dis"];
    $umail = $_SESSION["u"]["email"];

    $obj = json_decode($details);

    $ids = $obj -> id_array;

    $ids_count = count($ids);

    $order_id = uniqid();

    $title2 = "";

    for ($y = 0; $y <$ids_count; $y++) {

        $title = $obj -> title_array[$y];
        $title2 = $title2 . $title . ", ";
    }

    $items = rtrim($title2, ", ");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $address_num = $address_rs->num_rows;

    if ($address_num == 1) {

        $address_data = $address_rs->fetch_assoc();

        $city_id = $address_data["city_id"];
        $address = $address_data["line1"] . ", " . $address_data["line2"];

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
        $city_data = $city_rs->fetch_assoc();

        $subtotal = $obj->subtotal;
        $shipping = $obj->shipping;

        $amount = (intval($subtotal) + intval($shipping)) - intval($discount);

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $city = $city_data["city_name"];

        $merchant_secret = "MjgwNzA5MTUxMjMwMzcyMzQ2ODQzMTE2NzkxNjg1MjQzNjc5MDQyMQ==";
        $currency = "LKR";
        $merchant_id = 1221178;

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $items;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $address;
        $array["city"] = $city;
        $array["mail"] = $umail;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("2");
    }
} else {
    echo ("1");
}

?>