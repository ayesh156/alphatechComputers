<?php

require "connection.php";

$couponCode = $_POST["cc"];

if (!empty($couponCode)) {

    $coupon_rs = Database::search("SELECT * FROM `coupon` WHERE `code`='" . $couponCode . "' ");
    $coupon_num = $coupon_rs->num_rows;

    if ($coupon_num != 0) {
        $coupon_data = $coupon_rs->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        if ($coupon_data["start_date"] < $date && $date < $coupon_data["end_date"]) {

            if($coupon_data["status"] == '1') {
                echo ($coupon_data["discount"]);
                Database::iud("UPDATE `coupon` SET `status` = '0' WHERE `code`='" . $couponCode . "' ");
            } else {
                echo ("used");
            }

        } else if ($coupon_data["start_date"] > $date){
            echo ("notActive");
        } else if($coupon_data["end_date"] < $date) {
            echo ("expire");
        } 
        
    } else {
        echo ("invalid");
    }

} else {
    echo ("notSet");
}
