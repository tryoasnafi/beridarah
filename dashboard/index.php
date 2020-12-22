<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['level'] != "admin") {
    session_unset();
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Beri Darah</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../assets/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <?php require('topbar.php') ?>
            <?php require('sidebar.php') ?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <?php
                    include("../config/database.php");

                    // Total user
                    $sql = "SELECT COUNT(id_user) AS total_user FROM user WHERE level = 'user'";
                    $user = $conn->query($sql)->fetch_object();

                    // Total pendonor
                    $sql = "SELECT COUNT(id_donor) AS total_donor FROM donor";
                    $donor = $conn->query($sql)->fetch_object();

                    // Total pendonor dengan status aktif
                    $sql = "SELECT COUNT(id_donor) AS total_donor FROM donor WHERE is_active = TRUE";
                    $donor_active = $conn->query($sql)->fetch_object();

                    // Total request
                    $sql = "SELECT COUNT(id_request) AS total_request FROM request";
                    $request = $conn->query($sql)->fetch_object();

                    // Total request dengan status aktif
                    $sql = "SELECT COUNT(id_request) AS total_request FROM request WHERE status = TRUE";
                    $request_active = $conn->query($sql)->fetch_object();

                    ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-danger">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Pendonor Aktif</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $donor_active->total_donor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-info">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Total Pendonor</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $donor->total_donor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-warning">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Request Donor Aktif</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $request_active->total_request; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Total Request</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $request->total_request; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Total User</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $user->total_user ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <form method="post" class="needs-validation" novalidate="">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Quick Draft</h4>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the title
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea class="summernote-simple" style="display: none;"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer pt-0">
                                        <button class="btn btn-primary">Save Draft</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <?php require('footer.php'); ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>


    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>

</html>