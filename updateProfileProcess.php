<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $password = $_POST["p"];
    $gender = $_POST["g"];

    if (empty($mobile)) {
        echo ("Please enter your Mobile !!!");
    } else if (strlen($mobile) != 10) {
        echo ("Mobile must have 10 characters");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
        echo ("Invalid Mobile Number !!!");
    } else {

        if (isset($_FILES["image"])) {
            $image = $_FILES["image"];

            $allowed_image_ex = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_ex = $image["type"];

            if (!in_array($file_ex, $allowed_image_ex)) {
                echo ("Please select a valid image.");
            } else {

                $new_file_extention;

                if ($file_ex = "image/jpg") {
                    $new_file_extention = ".jpg";
                } else if ($file_ex = "image/jpeg") {
                    $new_file_extention = ".jpeg";
                } else if ($file_ex = "image/png") {
                    $new_file_extention = ".png";
                } else if ($file_ex = "image/svg+xml") {
                    $new_file_extention = ".svg";
                }

                $file_name = "assets/images/profile_img/" . $_SESSION["u"]["fname"] . "_" . uniqid() . $new_file_extention;

                move_uploaded_file($image["tmp_name"], $file_name);

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                $image_num = $image_rs->num_rows;

                if ($image_num == 1) {

                    Database::iud("UPDATE `profile_image` SET `code`='" . $file_name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                } else {

                    Database::iud("INSERT INTO `profile_image` (`code`,`user_email`) VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "') ");
                }
            }
        }

        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`password`='" . $password . "',`mobile`='" . $mobile . "',`gender_id`='" . $gender . "' WHERE `email`='" . $_SESSION["u"]["email"] . "' ");

        echo ("Success");
        
    }
    
} else {
    echo ("Please login first");
}
