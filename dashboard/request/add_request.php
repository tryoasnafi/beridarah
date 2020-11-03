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
    <title>Request Donor Darah</title>
</head>

<body>
    <form action="add_request_action.php" method="POST">
        Nama Pemohon : <input type="text" name="requester_name"> <br>
        No. Telp : <input type="text" name="requester_phone"> <br>
        Nama Pasien : <input type="text" name="recipient_name"> <br>
        Jenis Kelamin Pasien : <select name="recipient_gender" id="">
            <option selected disabled>JK Pasien</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
        </select> <br>
        Gol. Darah Pasien : <select name="blood_group" id="">
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
        Hubungan Dengan Pasien : <input type="text" name="relationship"> <br>
        Rumah Sakit: <input type="text" name="hospital" placeholder="RSUD. Arifin Ahmad, Pekanbaru"> <br>
        Pesan : <textarea name="message" id="" cols="30" rows="10" style="resize: vertical;"></textarea> <br>
        <button type="submit" name="add_request">Simpan</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>