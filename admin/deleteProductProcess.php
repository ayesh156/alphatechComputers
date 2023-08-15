<?php

session_start();
require "../connection.php";

if(isset($_SESSION["a"])){

    $pid = $_GET["id"];

    Database::iud("DELETE FROM `images` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `cart` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `invoice` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `review` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `watchlist` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `product` WHERE `id` = '".$pid."'");
    
    echo ("Success");

}else {
    echo "Please login First";
}


?>