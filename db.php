<?php

$dbhost = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = mysqli_connect($dbhost, $username, $password, $dbname);

if(!$conn) {
    echo mysqli_connect_error();
}