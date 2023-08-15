<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {

            $cart_data = $cart_rs->fetch_assoc();

            $qty = $cart_data["qty"];

            if($qty > 1) {

                $newQty = $qty - 1;
                Database::iud("UPDATE `cart` SET `qty`='" . $newQty . "' WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
                echo ("Deleted1");
                
            } else {

            Database::iud("DELETE FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
            echo ("Deleted2");

        }

        } else {
            echo ("No product found");
        }
    } else {
        echo ("Something went wrong.");
    }
} else {
    echo ("Please Login or Register.");
}
