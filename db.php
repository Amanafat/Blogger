<?php
$host = "localhost";  // Change this if your hosting provider requires a different MySQL hostname
$user = "u2js2kaz9flkd";  // Your MySQL database username
$password = "qpfyitcf4ncy";  // Your MySQL database password
$dbname = "db1jy5ac3iqewx";  // Your MySQL database name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
