<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');

if (isset($_POST['add_request'])) {
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_gender = $_POST['recipient_gender'];
    $blood_group = $_POST['blood_group'];
    $relationship = $_POST['relationship'];
    $hospital = $_POST['hospital'];
    $message = $_POST['message'];

    $sql = "INSERT INTO request (requester_name, requester_phone, recipient_name, recipient_gender, blood_group, relationship, hospital, message) VALUES ('$requester_name', '$requester_phone', '$recipient_name', '$recipient_gender', '$blood_group', '$relationship', '$hospital', '$message')";


    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
    }
}
