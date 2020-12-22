<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');
$id = $_GET['id'];
$sql = "SELECT * FROM donor WHERE id_donor = '$id'";
$user_data = $conn->query($sql)->fetch_object();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pendonor Aktif</title>

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
                        <form class="card" action="edit_donor_action.php" method="POST">
                            <div class="card-header">
                                <h4>Form Pendonor Darah</h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="fullname" placeholder="Nama Anda..." value="<?= $user_data->name ?>">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Jenis Kelamin (P / L)</label>
                                        <select class="custom-select" id="gender" name="gender">
                                            <option selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="L" <?= ($user_data->gender == "L") ? 'selected' : ''; ?>>Laki - laki</option>
                                            <option value="P" <?= ($user_data->gender == "P") ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputBirthday">Tanggal Lah</label>
                                        <input type="date" class="form-control" id="inputBirthday" name="birthday" value="<?= $user_data->birthday ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputDomicile">Kab/Kota Domisili</label>
                                        <input type="text" class="form-control" id="inputDomicile" name="domicile_city" placeholder="Pekanbaru" value="<?= $user_data->domicile_city ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPhone">No. Handphone</label>
                                        <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="08xxxxxxxx" value="<?= $user_data->phone ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputBloodGroup">Golongan Darah</label>
                                        <select class="custom-select" id="inputBloodGroup" name="blood_group">
                                            <option selected disabled>Pilih Gol. Darah</option>
                                            <option value="O-" <?= ($user_data->blood_group == "O-") ? 'selected' : ''; ?>>O-</option>
                                            <option value="O+" <?= ($user_data->blood_group == "O+") ? 'selected' : ''; ?>>O+</option>
                                            <option value="A-" <?= ($user_data->blood_group == "A-") ? 'selected' : ''; ?>>A-</option>
                                            <option value="A+" <?= ($user_data->blood_group == "A+") ? 'selected' : ''; ?>>A+</option>
                                            <option value="B-" <?= ($user_data->blood_group == "B-") ? 'selected' : ''; ?>>B-</option>
                                            <option value="B+" <?= ($user_data->blood_group == "B+") ? 'selected' : ''; ?>>B+</option>
                                            <option value="AB-" <?= ($user_data->blood_group == "AB-") ? 'selected' : ''; ?>>AB-</option>
                                            <option value="AB+" <?= ($user_data->blood_group == "AB+") ? 'selected' : ''; ?>>AB+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="is_active" id="status">
                                        <option value=1 <?= ($user_data->is_active == TRUE) ? 'selected' : ''; ?>>Aktif</option>
                                        <option value=0 <?= ($user_data->is_active == FALSE) ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" name="edit_donor">Simpan</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <?php require('../footer.php'); ?>
        </div>
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
</body>

</html>