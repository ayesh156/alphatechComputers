<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];

    

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."' ");
    $address_num = $address_rs -> num_rows;

    if ($address_num == 1) {

        Database::iud("UPDATE `user_has_address` SET `line1`='".$line1."',`line2`='".$line2."',`city_id`='".$city."',`postal_code`='".$pcode."' WHERE `user_email`='".$_SESSION["u"]["email"]."' ");

    } else {

        Database::iud("INSERT INTO `user_has_address` (`line1`,`line2`,`user_email`,`city_id`,`postal_code`) VALUES ('".$line1."','".$line2."','".$_SESSION["u"]["email"]."','".$city."','".$pcode."') ");
    }

    echo ("Success");

} else {
    echo ("Please login first");
}
