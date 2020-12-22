<?php
$host = 'localhost';
$username = 'admin';
$password = 'admin';
$database = 'beridarah';

$conn = new mysqli($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed : " . $conn->connect_error);
}

// echo "SUKSES";
