<?php

require "../connection.php";

$category = $_GET["c"];

$scategory_rs = Database::search("SELECT * FROM `category` WHERE `name` = '" . $category . "'");
$scategory_num = $scategory_rs->num_rows;

if ($scategory_num == 0) {

    Database::iud("INSERT INTO `category` (`name`) VALUES ('" . $category . "')");

    echo ("success");
} else {
    echo ("exists");
}
