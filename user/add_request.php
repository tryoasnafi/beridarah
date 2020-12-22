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


if (isset($_POST['add_request'])) {
    $id_user = $_SESSION['user']->id_user;
    $recipient_name = $_POST['recipient_name'];
    $recipient_gender = $_POST['recipient_gender'];
    $blood_group = $_POST['blood_group'];
    $hospital = $_POST['hospital'];
    $number_donors = $_POST['numberDonors'];
    $requester_name = $_POST['requester_name'];
    $requester_phone = $_POST['requester_phone'];
    $relationship = $_POST['relationship'];
    $message = $_POST['message'];

    $sql = "INSERT INTO request
                (id_user, recipient_name, recipient_gender, blood_group, hospital, number_donors, requester_name, requester_phone, relationship, message)
            VALUES 
                ('$id_user', '$recipient_name', '$recipient_gender','$blood_group', '$hospital', '$number_donors', '$requester_name', '$requester_phone', '$relationship','$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='index.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
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
                                    <button onclick="history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></button>
                                    <h4>Form Request Donor</h4>
                                </div>
                                <div class="card-body">
                                    <div class="section-title mt-0">Informasi Pasien</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nameRecipient">Nama Pasien</label>
                                            <input type="text" class="form-control" id="nameRecipient" name="recipient_name"" required>
                                    </div>
                                    <div class=" form-group col-md-6">
                                            <label for="gender">Jenis Kelamin (P / L)</label>
                                            <select class="custom-select" id="gender" name="recipient_gender" required>
                                                <option selected disabled>-- Pilih --</option>
                                                <option value="L">Laki - laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputHospital">Rumah Sakit</label>
                                            <input type="text" class="form-control" id="inputHospital" name="hospital" placeholder="RSUD. Arifin Ahmad" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputBloodGroup">Golongan Darah</label>
                                            <select class="custom-select" id="inputBloodGroup" name="blood_group" required>
                                                <option selected disabled>Pilih Gol. Darah</option>
                                                <option value="O-">O-</option>
                                                <option value="O+">O+</option>
                                                <option value="A-">A-</option>
                                                <option value="A+">A+</option>
                                                <option value="B-">B-</option>
                                                <option value="B+">B+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="AB+">AB+</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="numberOfDonors">Jumlah Pendonor</label>
                                            <input type="number" class="form-control" id="numberOfDonors" name="numberDonors" min="1" placeholder="Cth: 1 Orang" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMessage">Informasi Tambahan</label>
                                        <textarea class="form-control" id="inputMessage" name="message" style="height: 10rem;"></textarea>
                                    </div>
                                    <div class="section-title mt-0">Pendamping Pasien</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="nameRequester">Nama Pemohon</label>
                                            <input type="text" class="form-control" id="nameRequester" name="requester_name" placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPhone">No. Handphone</label>
                                            <input type="text" class="form-control" id="inputPhone" name="requester_phone" placeholder="No. Handphone (Aktif)" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputRelationship">Hubungan</label>
                                            <input type="text" class="form-control" id="inputRelationship" name="relationship" placeholder="Hubungan dengan pasien" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="add_request">Submit</button>
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