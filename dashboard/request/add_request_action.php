<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');

if (isset($_POST['add_request'])) {
    $id_user = $_SESSION['user']->id_user;
    $recipient_name = $_POST['recipient_name'];
    $recipient_gender = $_POST['recipient_gender'];
    $blood_group = $_POST['blood_group'];
    $hospital = $_POST['hospital'];
    $number_donors = $_POST['numberDonors'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $relationship = $_POST['relationship'];
    $message = $_POST['message'];

    $sql = "INSERT INTO request
                (id_user, recipient_name, recipient_gender, blood_group, hospital, number_donors, requester_name, requester_phone, relationship, message)
            VALUES 
                ('$id_user', '$recipient_name', '$recipient_gender','$blood_group', '$hospital', '$number_donors', '$requester_name', '$requester_phone', '$relationship','$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
    }
}
