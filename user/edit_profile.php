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


if (isset($_POST['edit_profile'])) {
    $id_user = $_SESSION['user']->id_user;
    $id_donor = $_POST['id_donor'];
    $name = $_POST['fullname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $domicile_city = $_POST['domicile_city'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $is_active = $_POST['is_active'];

    $confirm_user = $conn->query("SELECT * FROM donor WHERE id_user = '$id_user'")->num_rows;

    if ($id_donor != NULL) {
        $update = "UPDATE donor SET 
                    name = '$name',
                    gender = '$gender',
                    birthday = '$birthday',
                    domicile_city = '$domicile_city',
                    phone = '$phone', 
                    blood_group = '$blood_group', 
                    is_active  = '$is_active',
                    updated_date = CURRENT_TIMESTAMP
                WHERE id_donor = '$id_donor'";

        if ($conn->query($update) === TRUE) {
            echo "<script>
            alert('Data berhasil diubah!');
            window.location.href='profile.php';
            </script>";
        } else {
            echo "Error : " . $update . "<br>" . $conn->connect_error;
        }
    } else {
        $sql = "INSERT INTO donor 
                    (id_user, name, gender, birthday, domicile_city, phone, blood_group, is_active) 
                VALUES 
                    ('$id_user', '$name', '$gender', '$birthday', '$domicile_city', '$phone', '$blood_group', '$is_active')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='profile.php';
        </script>";
        } else {
            echo "Error : " . $sql . "<br>" . $conn->connect_error;
        }
    }
}
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
        <div class="row my-5">
            <div class="col-md-9 order-2 order-md-1">
                <div class="bg-white shadow-sm">
                    <section class="section">
                        <div class="section-body">
                            <form class="card" action="" method="POST">
                                <div class="card-header">
                                    <h4>Form Pendonor Darah</h4>
                                </div>
                                <?php
                                $id_user = $_SESSION['user']->id_user;
                                $data = $conn->query("SELECT * FROM donor WHERE id_user = '$id_user'")->fetch_object();

                                $id_donor = $name = $gender = $birthday = $domicile_city = $phone = $blood_group = $is_active = NULL;

                                if ($data != NULL) {
                                    $id_donor = $data->id_donor;
                                    $name = $data->name;
                                    $gender = $data->gender;
                                    $birthday = $data->birthday;
                                    $domicile_city = $data->domicile_city;
                                    $phone = $data->phone;
                                    $blood_group = $data->blood_group;
                                    $is_active = $data->is_active;
                                }
                                ?>
                                <input type="hidden" name="id_donor" value="<?= $id_donor ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="fullname" value="<?= $name ?>" placeholder="Nama Anda...">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gender">Jenis Kelamin (P / L)</label>
                                            <select class="custom-select" id="gender" name="gender">
                                                <option disabled>Pilih Jenis Kelamin</option>
                                                <option <?= ($gender == 'L') ? 'selected' : '' ?> value="L">Laki - laki</option>
                                                <option <?= ($gender == 'P') ? 'selected' : '' ?> value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputBirthday">Tanggal Lah</label>
                                            <input type="date" class="form-control" id="inputBirthday" name="birthday" value="<?= $birthday ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputDomicile">Kab/Kota Domisili</label>
                                            <input type="text" class="form-control" id="inputDomicile" name="domicile_city" placeholder="Pekanbaru" value="<?= $domicile_city ?>">
                                        </div>
                                        <div class=" form-group col-md-3">
                                            <label for="inputPhone">No. Handphone</label>
                                            <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="08xxxxxxxx" value="<?= $phone ?>">
                                        </div>
                                        <div class=" form-group col-md-3">
                                            <label for="inputBloodGroup">Golongan Darah</label>
                                            <select class="custom-select" id="inputBloodGroup" name="blood_group">
                                                <option selected disabled>Pilih Gol. Darah</option>
                                                <option <?= ($blood_group == 'O-') ? 'selected' : '' ?> value="O-">O-</option>
                                                <option <?= ($blood_group == 'O+') ? 'selected' : '' ?> value="O+">O+</option>
                                                <option <?= ($blood_group == 'A-') ? 'selected' : '' ?> value="A-">A-</option>
                                                <option <?= ($blood_group == 'A+') ? 'selected' : '' ?> value="A+">A+</option>
                                                <option <?= ($blood_group == 'B-') ? 'selected' : '' ?> value="B-">B-</option>
                                                <option <?= ($blood_group == 'B+') ? 'selected' : '' ?> value="B+">B+</option>
                                                <option <?= ($blood_group == 'AB-') ? 'selected' : '' ?> value="AB-">AB-</option>
                                                <option <?= ($blood_group == 'AB+') ? 'selected' : '' ?> value="AB+">AB+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="custom-select" name="is_active" id="status">
                                            <option <?= ($is_active == TRUE) ? 'selected' : '' ?> value=1>Aktif</option>
                                            <option <?= ($is_active == FALSE) ? 'selected' : '' ?> value=0>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="edit_profile">Simpan</button>
                                    <button class="btn btn-danger" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-3 order-1 order-md-2">
                <div class="bg-success px-3 mb-2 rounded text-white">
                    <p class="font-weight-bold py-1">Yuk, Lengkapi <a class="" href=""><span class="badge badge-light badge-sm">PROFIL</span></a> kamu, dan aktifkan fitur pendonor </p>
                </div>
                <div class="card">
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
    </script>
</body>

</html>