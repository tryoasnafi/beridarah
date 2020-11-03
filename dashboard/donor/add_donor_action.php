<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');

if (isset($_POST['add_donor'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $domicile_city = $_POST['domicile_city'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];

    $sql = "INSERT INTO donor (name, gender, birthday, domicile_city, phone, blood_group) VALUES ('$name', '$gender', '$birthday', '$domicile_city', '$phone', '$blood_group')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
    }
}
