<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'beridarah';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errno) {
    die("Connection failed : " . $conn->connect_error);
}
