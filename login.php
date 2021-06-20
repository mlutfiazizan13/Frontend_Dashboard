<?php
include "config/koneksi.php";
include "library/controller.php";

$go = new controller();

$tabel = "login";
@$username = $_POST['user'];
@$password = base64_encode($_POST['pass']);
$redirect = "index.php/?menu=dashboard";

if(isset($_POST['login'])){
    $go->login($con, $tabel, $username, $password, $redirect);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<h3 class="text-center py-5">Login</h3>
<form action="" method="post">
    <table align="center" class="table table-borderless w-50">
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" class="form-control" name="user" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" class="form-control" name="pass" required></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" class="btn btn-primary w-100" name="login" value="LOGIN"></td>
        </tr>
    </table>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
</body>
</html>



