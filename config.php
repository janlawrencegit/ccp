<?php
$servername = "localhost"; // or your server
$username = "root";        // your DB username
$password = "";            // your DB password
$dbname = "ccp";           // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>