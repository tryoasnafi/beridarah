<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');
$id = $_GET['id'];
$sql = "SELECT * FROM donor WHERE id={$id}";
$data = $conn->query($sql);
$user_data = mysqli_fetch_object($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadi Pendonor</title>
</head>

<body>
    <form action="edit_donor_action.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        Nama Lengkap : <input type="text" name="name" value="<?= $user_data->name ?>"> <br>
        Jenis Kelamin : <select name="gender" id="">
            <option disabled>JK Pasien</option>
            <option value="L" <?= ($user_data->gender == "L") ? 'selected' : ''; ?>>Laki - laki</option>
            <option value="P" <?= ($user_data->gender == "P") ? 'selected' : ''; ?>>Perempuan</option>
        </select> <br>
        Tgl. Lahir : <input type="date" name="birthday" id="" value="<?= $user_data->birthday ?>"> <br>
        Kab/Kota Domisili : <input type="text" name="domicile_city" value="<?= $user_data->domicile_city ?>"> <br>
        No. Telp : <input type="text" name="phone" value="<?= $user_data->phone ?>"> <br>
        Golongan Darah : <select name="blood_group" id="">
            <option disabled>Pilih Gol. Darah</option>
            <option value="O-" <?= ($user_data->blood_group == "O-") ? 'selected' : ''; ?>>O-</option>
            <option value="O+" <?= ($user_data->blood_group == "O+") ? 'selected' : ''; ?>>O+</option>
            <option value="A-" <?= ($user_data->blood_group == "A-") ? 'selected' : ''; ?>>A-</option>
            <option value="A+" <?= ($user_data->blood_group == "A+") ? 'selected' : ''; ?>>A+</option>
            <option value="B-" <?= ($user_data->blood_group == "B-") ? 'selected' : ''; ?>>B-</option>
            <option value="B+" <?= ($user_data->blood_group == "B+") ? 'selected' : ''; ?>>B+</option>
            <option value="AB-" <?= ($user_data->blood_group == "AB-") ? 'selected' : ''; ?>>AB-</option>
            <option value="AB+" <?= ($user_data->blood_group == "AB+") ? 'selected' : ''; ?>>AB+</option>
        </select> <br>
        Status : <select name="is_active" id="">
            <option value=1 <?= ($user_data->is_active == 1) ? 'selected' : ''; ?>>Aktif</option>
            <option value=0 <?= ($user_data->is_active == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
        </select> <br>
        <button type="submit" name="edit_donor">Simpan</button>
    </form>
</body>

</html>