<?php

require "connection.php";

$name = $_POST["n"];
$email = $_POST["e"];
$subject = $_POST["s"];
$message = $_POST["m"];

if (empty($name)) {
    echo ("Please enter your Name !!!");
} else if (empty($email)) {
    echo ("Please enter your Email !!!");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($subject)) {
    echo ("Please enter Subject !!!");
} else if (strlen($subject) >= 100) {
    echo ("Subject must have less than 100 characters");
} else if (empty($message)) {
    echo ("Please enter your Message !!!");
} else {

    Database::iud("INSERT INTO `message` (`email`,`name`,`subject`,`message`) VALUES ('".$email."','".$name."','".$subject."','".$message."') ");

    echo ("Success");
}
