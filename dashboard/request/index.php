<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}


include('../../config/database.php');
$no = 1;
$sql = "SELECT id, requester_name, requester_phone, recipient_name, blood_group, hospital FROM request";
$data = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membutuhkan Donor Darah</title>
</head>

<body>
    <div>
        <h1>Membutuhkan Donor Darah Segera</h1>
        <a href="add_request.php">+ Buat Request</a>
        <br>
        <br>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Golongan Darah</th>
                <th>Rumah Sakit</th>
                <th>Hubungi</th>
                <th>OPSI</th>
            </tr>
            <?php while ($user_data = mysqli_fetch_object($data)) {  ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user_data->recipient_name ?></td>
                    <td><?= $user_data->blood_group ?></td>
                    <td><?= $user_data->hospital ?></td>
                    <td><?= $user_data->requester_phone . " ({$user_data->requester_name})" ?></td>
                    <td>
                        <a href="edit_request.php?id=<?= $user_data->id ?>">EDIT</a>
                        <span> | </span>
                        <a href="delete_request.php?id=<?= $user_data->id ?>" onclick="return confirm_delete()">HAPUS</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <script>
        confirm_delete = () => {
            return confirm("Apakah Anda yakin menghapus data ini?") ? true : false;
        }
    </script>
</body>

</html>