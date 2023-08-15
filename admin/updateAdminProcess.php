<?php

session_start();

require "../connection.php";

if (isset($_SESSION["a"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $email = $_POST["e"];
    $mobile = $_POST["m"];
    $gender = $_POST["g"];

    if(empty($fname)) {
        echo ("Please enter your First Name !!!");
    } else if(strlen($fname) > 50) {
        echo ("First Name must have less than 50 characters");
    } else if(empty($lname)) {
        echo("Please enter your Last Name !!!");
    } else if(strlen($lname) > 50) {
        echo ("Last Name must have less than 50 characters");
    } else if(empty($email)) {
        echo("Please enter your Email !!!");
    } else if(strlen($email) >= 100) {
        echo ("Email must have less than 100 characters");
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email !!!");
    } else if(empty($mobile)) {
        echo ("Please enter your Mobile !!!");
    } else if(strlen($mobile) != 10) {
        echo ("Mobile must have 10 characters");
    } else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)) {
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

                $uniqid = uniqid();

                $file_name = "../assets/images/admin_img/" . $fname . "_" . $uniqid . $new_file_extention;
                $file_name2 = "assets/images/admin_img/" . $fname . "_" . $uniqid . $new_file_extention;

                move_uploaded_file($image["tmp_name"], $file_name);

                $image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $_SESSION["a"]["email"] . "' ");
                $image_num = $image_rs->num_rows;

                if ($image_num == 1) {

                    Database::iud("UPDATE `admin_image` SET `path`='" . $file_name2 . "' WHERE `admin_email`='" . $_SESSION["a"]["email"] . "' ");
                } else {

                    Database::iud("INSERT INTO `admin_image` (`path`,`admin_email`) VALUES ('" . $file_name . "','" . $_SESSION["a"]["email"] . "') ");
                }
            }
        }

        Database::iud("UPDATE `admin` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "',`gender_id`='" . $gender . "' WHERE `email`='" . $_SESSION["a"]["email"] . "' ");

        echo ("Success");
        
    }
    
} else {
    echo ("Please login first");
}
