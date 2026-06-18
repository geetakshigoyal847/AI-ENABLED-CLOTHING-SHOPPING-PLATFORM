<?php

$host = "sql301.infinityfree.com";
$user = "if0_42204142";
$password = "Geetakshi1105";
$dbname = "if0_42204142_stylenest";


$conn = mysqli_connect($host, $user, $password, $dbname);


if (!$conn) {

    die("Database failed: " . mysqli_connect_error());

}


mysqli_set_charset($conn, "utf8mb4");

?>