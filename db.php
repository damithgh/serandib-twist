<?php
$servername = "localhost";
$username = "amk1012409";
$password = "JfoE7lkm";
$dbname = "wp_amk1012409";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>