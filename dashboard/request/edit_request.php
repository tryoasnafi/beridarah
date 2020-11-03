<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');
$id = $_GET['id'];
$sql = "SELECT * FROM request WHERE id={$id}";
$data = $conn->query($sql);
$user_data = mysqli_fetch_object($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Donor Darah</title>
</head>

<body>
    <h1>Edit Data</h1>
    <form action="edit_request_action.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        Nama Pemohon : <input type="text" name="requester_name" value="<?= $user_data->requester_name ?>"> <br>
        No. Telp : <input type="text" name="requester_phone" value="<?= $user_data->requester_phone ?>"> <br>
        Nama Pasien : <input type="text" name="recipient_name" value="<?= $user_data->recipient_name ?>"> <br>
        Jenis Kelamin Pasien : <select name="recipient_gender" id="">
            <option disabled>JK Pasien</option>
            <option value="L" <?= ($user_data->recipient_gender == "L") ? 'selected' : ''; ?>>Laki - laki</option>
            <option value="P" <?= ($user_data->recipient_gender == "P") ? 'selected' : ''; ?>>Perempuan</option>
        </select> <br>
        Gol. Darah Pasien : <select name="blood_group" id="">
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
        Hubungan Dengan Pasien : <input type="text" name="relationship" value="<?= $user_data->relationship; ?>"> <br>
        Rumah Sakit: <input type="text" name="hospital" placeholder="RSUD. Arifin Ahmad, Pekanbaru" value="<?= $user_data->hospital; ?>"> <br>
        Pesan : <textarea name="message" id="" cols="30" rows="10" style="resize: vertical;"><?= $user_data->message; ?></textarea> <br>
        <button type="submit" name="edit_request">Simpan</button>
    </form>
</body>

</html>