<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../login.php");
    exit;
}

include_once('../../config/database.php');

if (isset($_POST['edit_user'])) {
    // Ambil data
    $id = $_POST['id'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $emailOld = $_POST['emailOld'];
    $role = $_POST['role'];

    // Cek apakah email telah digunakan
    if ($email != $emailOld) {
        $confirm_email = $conn->query("SELECT email FROM user WHERE email = '$email'")->num_rows;
        if ($confirm_email > 0) {
            echo "<script>
            alert('Email sudah digunakan!')
            window.location.href='edit_user.php';
            </script>";
        }
    }

    // Jika pass validasi, store data
    $sql = "UPDATE user SET 
                name = '$name',
                email = '$email',
                level = '$role',
                updated_date = CURRENT_TIMESTAMP
            WHERE id_user = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil diubah!');
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
    <title>User &mdash; Beri Darah</title>

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
                        <h1>User</h1>
                    </div>

                    <div class="section-body">
                        <form class="card" action="" method="POST">
                            <div class="card-header">
                                <h4>Edit User</h4>
                            </div>

                            <?php
                            $id = $_GET['id'];
                            $datas = $conn->query("SELECT * FROM user WHERE id_user = '$id'");
                            $user_data = mysqli_fetch_object($datas);
                            ?>
                            <div class="card-body">
                                <input type="hidden" class="form-control" name="id" value="<?= $id ?>">
                                <input type="hidden" class="form-control" name="emailOld" value="<?= $user_data->email ?>">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="fullname" required value="<?= $user_data->name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="emailUser">Email</label>
                                    <input type="email" class="form-control" id="emailUser" name="email" required value="<?= $user_data->email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="roleUser">Role / Level</label>
                                    <select class="custom-select" name="role" id="roleUser" required>
                                        <option disabled> -- Select User Role --</option>
                                        <option <?= ($user_data->level == 'admin') ? 'selected' : '' ?> value="admin">Admin</option>
                                        <option <?= ($user_data->level == 'user') ? 'selected' : '' ?> value="user">User</option>
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" name="edit_user">Submit</button>
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