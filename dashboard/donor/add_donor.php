<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadi Pendonor</title>
</head>

<body>
    <form action="add_donor_action.php" method="POST">
        Nama Lengkap : <input type="text" name="name"> <br>
        Jenis Kelamin : <select name="gender" id="">
            <option selected disabled>JK Pasien</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
        </select> <br>
        Tgl. Lahir : <input type="date" name="birthday" id=""> <br>
        Kab/Kota Domisili : <input type="text" name="domicile_city"> <br>
        No. Telp : <input type="text" name="phone"> <br>
        Golongan Darah : <select name="blood_group" id="">
            <option selected disabled>Pilih Gol. Darah</option>
            <option value="O-">O-</option>
            <option value="O+">O+</option>
            <option value="A-">A-</option>
            <option value="A+">A+</option>
            <option value="B-">B-</option>
            <option value="B+">B+</option>
            <option value="AB-">AB-</option>
            <option value="AB+">AB+</option>
        </select> <br>
        <button type="submit" name="add_donor">Simpan</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>