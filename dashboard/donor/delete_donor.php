<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');

$id = $_GET['id'];

$delete = "DELETE FROM donor WHERE id_donor='$id'";

if ($conn->query($delete) === TRUE) {
    echo "<script>
    alert('Data berhasil dihapus!');
    window.location.href='index.php';
    </script>";
} else {
    echo "Error : " . $delete . "<br>" . $conn->connect_error;
}
