<?php
function getDBConnection() {
    $conn = mysqli_connect("localhost", "root", "", "cultive8_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>