<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include('../../config/database.php');
$no = 1;
$sql = "SELECT id, name, gender, domicile_city, blood_group, phone 
        FROM donor 
        WHERE is_active = TRUE";
$data = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendonor Aktif </title>
</head>

<body>
    <div>
        <h1>Pendonor Darah</h1>
        <a href="add_donor.php">+ Jadi Pendonor</a>
        <br>
        <br>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama Pendonor</th>
                <th>Jenis Kelamin</th>
                <th>Domisili</th>
                <th>Golongan Darah</th>
                <th>No. Telp</th>
                <th>OPSI</th>
            </tr>
            <?php while ($user_data = mysqli_fetch_object($data)) {  ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user_data->name ?></td>
                    <td><?= $user_data->gender ?></td>
                    <td><?= $user_data->domicile_city ?></td>
                    <td><?= $user_data->blood_group ?></td>
                    <td><?= $user_data->phone ?></td>
                    <td>
                        <a href="edit_donor.php?id=<?= $user_data->id ?>">EDIT</a>
                        <span> | </span>
                        <a href="delete_donor.php?id=<?= $user_data->id ?>" onclick="return confirm_delete()">HAPUS</a>
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