<?php
session_start();

function getDBConnection() {
    $conn = mysqli_connect("localhost", "root", "", "cultive8_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

session_destroy();
header("Location: index.php");
exit();
?>