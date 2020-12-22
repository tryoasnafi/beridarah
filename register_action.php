<?php

include_once('config/database.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $level = 'user';

    // Cek apakah email telah digunakan
    $confirm_email = $conn->query("SELECT email FROM user WHERE email = '$email'")->num_rows;
    if ($confirm_email > 0) {
        echo "<script>
        alert('Email sudah digunakan!')
        window.location.href='register.php';
        </script>";
        exit;
    }

    // Cek apakah email telah digunakan
    if ($password != $password2) {
        echo "<script>
        alert('Password tidak sama!')
        window.location.href='register.php';
        </script>";
        exit;
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, password, level)
            VALUES ('$name', '$email', '$password', '$level')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='login.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
    }
}
