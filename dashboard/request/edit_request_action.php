<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}


include_once('../../config/database.php');

if (isset($_POST['edit_request'])) {
    $id = $_POST['id'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_gender = $_POST['recipient_gender'];
    $blood_group = $_POST['blood_group'];
    $relationship = $_POST['relationship'];
    $hospital = $_POST['hospital'];
    $message = $_POST['message'];

    $update = "UPDATE request SET 
                requester_name = '$requester_name',
                requester_phone = '$requester_phone',
                recipient_name = '$recipient_name',
                recipient_gender = '$recipient_gender',
                blood_group = '$blood_group', 
                relationship = '$relationship', 
                hospital  = '$hospital', 
                message = '$message',
                updated_date = CURRENT_TIMESTAMP
            WHERE id = '$id'";


    if ($conn->query($update) === TRUE) {
        echo "<script>
        alert('Data berhasil diubah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $update . "<br>" . $conn->connect_error;
    }
}
