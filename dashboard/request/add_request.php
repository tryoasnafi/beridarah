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
    <title>Request Donor</title>

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
                        <h1>Request Donor</h1>
                    </div>

                    <div class="section-body">
                        <form class="card" action="add_request_action.php" method="POST">
                            <div class="card-header">
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