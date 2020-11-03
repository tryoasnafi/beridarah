<?php

session_start();

include_once('config/database.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM user WHERE email='$email'");
    $data_user = $query->fetch_object();
    // validasi password
    if (password_verify($password, $data_user->password)) {
        $_SESSION['user'] = $data_user;

        header("Location: dashboard/");
        exit;
    } else {
        header("Location: login.php");
    }
}
