<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}


include_once('../../config/database.php');

if (isset($_POST['edit_request'])) {
    $id = $_POST['id'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_gender = $_POST['recipient_gender'];
    $blood_group = $_POST['blood_group'];
    $hospital = $_POST['hospital'];
    $number_donors = $_POST['numberDonors'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $relationship = $_POST['relationship'];
    $message = $_POST['message'];

    $update = "UPDATE request SET 
                recipient_name = '$recipient_name',
                recipient_gender = '$recipient_gender',
                blood_group = '$blood_group', 
                hospital  = '$hospital', 
                number_donors = '$number_donors',
                requester_name = '$requester_name',
                requester_phone = '$requester_phone',
                relationship = '$relationship', 
                message = '$message',
                updated_date = CURRENT_TIMESTAMP
            WHERE id_request = '$id'";


    if ($conn->query($update) === TRUE) {
        echo "<script>
        alert('Data berhasil diubah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $update . "<br>" . $conn->connect_error;
    }
}
