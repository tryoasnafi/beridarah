<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard/");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="login_action.php" method="POST" onsubmit="validate()">
        Email : <input type="email" name="email" id="">
        Password : <input type="password" name="password" id="">
        <button type="submit" name="login">Register</button>
    </form>
</body>

</html>