<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $wishlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
        $wishlist_num = $wishlist_rs->num_rows;

        if ($wishlist_num == 1) {

            $wishlist_data = $wishlist_rs->fetch_assoc();

            Database::iud("DELETE FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
            echo ("Deleted");

        } else {
            echo ("No product found");
        }
    } else {
        echo ("Something went wrong.");
    }
} else {
    echo ("Please Login or Register.");
}
