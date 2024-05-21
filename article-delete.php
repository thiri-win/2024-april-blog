<?php

session_start();

include 'db.php';

if (isset($_SESSION['auth'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM articles WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location: index.php');
        } else {
            echo mysqli_connect();
        }
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
