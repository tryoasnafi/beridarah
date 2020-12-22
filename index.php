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
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-lg py-3">
            <a class="navbar-brand text-uppercase font-weight-bolder" href="#">Beri Darah</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                <form class="form-inline my-2 my-lg-0 ">
                    <a href="login.php" class="btn btn-danger rounded-pill shadow py-2 px-4 mr-1">Masuk</a>
                    <a href="register.php" class="btn btn-white rounded-pill shadow py-2 px-4">Daftar</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-lg py-3">
        <!-- Hero -->
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-item-center flex-column py-1 order-2 order-md-1">
                <h2>Anda membutuhkan darah?</h2>
                <p class="py-2">Kami siap membantu mencarikan pendonor ketika stok darah yang dibutuhkan di PMI atau Bank Darah di Rumah Sakit kurang atau kosong.</p>
                <a class="btn btn-danger shadow py-2 px-4" href="register.php">Ayo Daftar!</a>
            </div>
            <div class="col-md-8 py-1 order-1 order-md-2">
                <img class="img-fluid" src="assets/img/hero.png" alt="" srcset="">
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12 py-5 text-center">
                <h3>Pencarian Kebutuhan Darah</h3>
                <hr width="100px" style="border-top: 2px solid;">
            </div>
            <?php
            include_once("config/database.php");

            $datas = $conn->query("SELECT * FROM request ORDER BY created_date DESC LIMIT 20");
            while ($data = mysqli_fetch_object($datas)) {
            ?>
                <div class="col-12 col-md-6 mb-4">

                    <div class="card shadow">
                        <div class="card-body">
                            <h4>
                                <span class="badge badge-danger text-uppercase"># Urgent</span>
                            </h4>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th scope="row" class="col-sm-4">Nama Pasien</th>
                                    <td class="col-sm-8">: <?= $data->recipient_name; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Golongan Darah</th>
                                    <td class="col-sm-8">: <?= $data->blood_group; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Jumlah Pendonor</th>
                                    <td class="col-sm-8">: <?= $data->number_donors; ?> Orang</td>
                                </tr>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Rumah Sakit</th>
                                    <td class="col-sm-8">: <?= $data->hospital; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Narahubung</th>
                                    <td class="col-sm-8">: <?= $data->requester_name; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Kontak</th>
                                    <td class="col-sm-3">: <?= $data->requester_phone; ?>
                                        <div class="mt-2">
                                            <button class="btn btn-outline-info btn-sm mb-1" data-toggle="tooltip" data-placement="top" title="Copy to clipboard" data-clipboard-text="<?= $data->requester_phone; ?>">Salin Kontak</button>
                                            <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Chat Narahubung" href="https://wa.me/<?= $data->requester_phone ?>?text=Hallo kak <?= $data->requester_name ?>, Saya dapat informasi dari website BeriDarah.ID kalau ada kebutuhan pendonor darah <?= $data->blood_group; ?> untuk <?= $data->recipient_name; ?>. Saya bersedia untuk menjadi Pendonor Darah Sukarela untuk <?= $data->recipient_name; ?>, saya harus ke mana untuk mendonorkan darah? Nama saya "><i class="fab fa-whatsapp"></i> Chat</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-sm-4">Terdaftar</th>
                                    <td class="col-sm-8">: <?= $data->created_date; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Main Content -->
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