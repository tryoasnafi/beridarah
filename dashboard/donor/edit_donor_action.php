<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}


include_once('../../config/database.php');

if (isset($_POST['edit_donor'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $domicile_city = $_POST['domicile_city'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $is_active = $_POST['is_active'];

    $update = "UPDATE donor SET 
                name = '$name',
                gender = '$gender',
                birthday = '$birthday',
                domicile_city = '$domicile_city',
                phone = '$phone', 
                blood_group = '$blood_group', 
                is_active  = '$is_active',
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
