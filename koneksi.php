<?php

$server = "localhost";
$username = "root";
$password = "root";
$database = "DB_SAW_PRIMA_MOTOR";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 