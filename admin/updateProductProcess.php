<?php

session_start();
require "../connection.php";

if (isset($_SESSION["a"])) {

    $pid = $_POST["id"];

    $title = $_POST["t"];
    $colour = $_POST["c"];
    $qty = $_POST["q"];
    $price = $_POST["p"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];

    $simage_rs = Database::search("SELECT * FROM `images`  WHERE `product_id`='" . $pid . "' ");
    $simage_num = $simage_rs -> num_rows;

    $length = sizeof($_FILES);

    if ($length <= 4 && $length > 0) {

        Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`colour_id`='" . $colour . "',`price`='" . $price . "',`delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`description`='" . $description . "' WHERE `id`='" . $pid . "' ");

        Database::iud("DELETE FROM `images` WHERE `product_id`='" . $pid . "' ");


        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {

                $img_file = $_FILES["i" . $x];
                $file_type = $img_file["type"];

                if (in_array($file_type, $allowed_img_extentions)) {

                    $new_img_extention;

                    if ($file_type == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_type == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_type == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_type == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $uniqid = uniqid();

                    $file_name = "../assets/images/product_images/" . $title  . "_" . $uniqid  . $new_img_extention;
                    $file_name2 = "assets/images/product_images/" . $title  . "_" . $uniqid  . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $file_name2 . "','" . $pid . "') ");

                } else {
                    echo ("File type not allowed!");
                }
            }
        }

        echo ("Success");

    } else if($simage_num != 0) {

        Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`colour_id`='" . $colour . "',`price`='" . $price . "',`delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`description`='" . $description . "' WHERE `id`='" . $pid . "' ");

        echo ("Success");
        
    } else {
        echo ("Invalid Image Count!");
    }
} else {
    echo ("Please login First");
}
