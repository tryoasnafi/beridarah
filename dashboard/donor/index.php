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
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Pendonor Aktif</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <?php require('../topbar.php'); ?>
            <?php require('../sidebar.php'); ?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Donor Darah</h1>
                    </div>
                    <div class="section-body">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="add_donor.php" class="btn btn-success">Tambah Donor</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pendonor</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Domisili</th>
                                                <th>Golongan Darah</th>
                                                <th>No. Telp</th>
                                                <th>Status</th>
                                                <th>OPSI</th>
                                            </tr>
                                            <?php
                                            include('../../config/database.php');
                                            $batas = 5;
                                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                            $first = ($page > 1) ? (($page - 1) * $batas) : 0;
                                            $previous = $page - 1;
                                            $next = $page + 1;
                                            $count_data = mysqli_num_rows($conn->query("SELECT * FROM donor"));
                                            $total_page = ceil($count_data / $batas);

                                            $no = $first + 1;
                                            $sql = "SELECT * FROM donor LIMIT $first, $batas";
                                            $data = $conn->query($sql);
                                            while ($user_data = mysqli_fetch_object($data)) {  ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $user_data->name ?></td>
                                                    <td><?= ($user_data->gender == 'L') ? "Laki - laki" : "Perempuan"; ?></td>
                                                    <td><?= $user_data->domicile_city ?></td>
                                                    <td><?= $user_data->blood_group ?></td>
                                                    <td><?= $user_data->phone ?></td>
                                                    <td><?= ($user_data->is_active == TRUE) ? 'Aktif' : 'Tidak Aktif' ?></td>
                                                    <td>
                                                        <a class="btn btn-icon btn-primary" href="edit_donor.php?id=<?= $user_data->id_donor ?>">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-icon btn-danger" href="delete_donor.php?id=<?= $user_data->id_donor ?>" onclick="return confirm_delete()">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        <ul class="pagination mb-0">
                                            <li class="page-item">
                                                <a class="page-link <?= ($page > 1) ? '"href=?page=' . $previous : ' btn disabled"'; ?> tabindex=" -1">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                            <?php
                                            for ($i = 1; $i <= $total_page; $i++) {
                                            ?>
                                                <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                            <?php } ?>
                                            <li class="page-item">
                                                <a class="page-link <?= ($page < $total_page) ? '" href=?page=' . $next : ' btn disabled" href' ?>>
                                                    <i class=" fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php require('../footer.php'); ?>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="../../assets/js/scripts.js"></script>
    <script src="../../assets/js/custom.js"></script>

    <script>
        confirm_delete = () => {
            return confirm("Apakah Anda yakin menghapus data ini?") ? true : false;
        }
    </script>
</body>

</html>