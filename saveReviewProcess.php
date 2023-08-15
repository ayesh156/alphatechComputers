<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $mail = $_SESSION["u"]["email"];
    $pid = $_POST["p"];
    $review = $_POST["r"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d -> format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `review` (`review`,`date`,`product_id`,`user_email`) VALUES ('".$review."','".$date."','".$pid."','".$mail."') ");
    
    echo "Success";

}

?>