<?php

include_once('config/database.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Data berhasil ditambah!');
        window.location.href='register.php';
        </script>";
    } else {
        echo "Error : " . $sql . "<br>" . $conn->connect_error;
    }
}
