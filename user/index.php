<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['level'] != "user") {
    session_unset();
    header("Location: ../login.php");
    exit;
}

include_once("../config/database.php");
$email = $_SESSION['user']->email;
$data = $conn->query("SELECT * FROM user WHERE email = '$email'")->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Beri Darah</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" style="left: 0px; position: relative">
        <div class="container-lg">
            <a class="navbar-brand text-uppercase text-danger font-weight-bolder" href="#">Beri Darah</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto text-uppercase font-weight-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Permohonan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Artikel</a>
                    </li>
                </ul>
            </div>
            <h5 class="mr-2 navbar-text text-dark my-0">
                Hallo, <span class="badge badge-danger badge-pill"><?= $data->name; ?> </span>
            </h5>
        </div>

    </nav>
    <div class="container-lg">
        <div class="row my-4">
            <div class="col-md-9">
                <div class="bg-white shadow-sm">
                    <div class="section-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Permohonan Donor Darah Kamu</h5>
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <a href="add_request.php" class="btn btn-success"><i class="fab fa-telegram-plane"></i> Ajukan Permohonan Baru</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pasien</th>
                                            <th>Gol. Darah</th>
                                            <th>Rumah Sakit</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        include('../config/database.php');
                                        $batas = 5;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $first = ($page > 1) ? (($page - 1) * $batas) : 0;
                                        $previous = $page - 1;
                                        $next = $page + 1;
                                        $count_data = mysqli_num_rows($conn->query("SELECT * FROM user"));
                                        $total_page = ceil($count_data / $batas);

                                        $no = $first + 1;
                                        $id_user = $_SESSION['user']->id_user;
                                        $data = $conn->query("SELECT * FROM request WHERE id_user = '$id_user' ORDER BY created_date DESC LIMIT $first, $batas");
                                        while ($user_data = mysqli_fetch_object($data)) {  ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $user_data->recipient_name ?></td>
                                                <td><?= $user_data->blood_group ?></td>
                                                <td><?= $user_data->hospital ?></td>
                                                <td><?= date_format(date_create($user_data->created_date), 'd-m-Y') ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-icon btn-primary" href="edit_request.php?id=<?= $user_data->id_request ?>">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-icon btn-danger" href="delete_request.php?id=<?= $user_data->id_request ?>" onclick="return confirm_delete()">
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
            </div>
            <div class="col-md-3">
                <div class="bg-success px-3 mb-2 rounded text-white">
                    <p class="font-weight-bold py-1">Yuk, Lengkapi <a class="" href=""><span class="badge badge-light badge-sm">PROFIL</span></a> kamu, dan aktifkan fitur pendonor </p>
                </div>
                <div class="card-body bg-white card shadow-sm">
                    <h5 class="card-title">Daftar Menu</h5>
                    <hr align="left" style="border-top: 2px solid" width="150rem">
                    <ul class="nav flex-column">
                        <li class="nav-item py-1">
                            <a class="nav-link btn btn-primary" href="index.php"><i class="fas fa-stethoscope"></i> Permohononan Anda</a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="nav-link btn btn-info" href="profile.php"><i class="fas fa-user"></i> Profil</a>
                        </li>
                        <li class="nav-item py-1">
                            <a class="nav-link btn btn-danger" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        var clipboard = new ClipboardJS('.btn');

        confirm_delete = () => {
            return confirm("Apakah Anda yakin menghapus data ini?") ? true : false;
        }
    </script>
</body>

</html>