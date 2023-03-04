<?php

ini_set('display_errors',true);
error_reporting(E_ALL);

session_start();
$usuario = $_SESSION['user'];


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sitio.php</title>
</head>
<body>
    <h1>Bienvenido a este sitio web <?= $usuario ?></h1>
</body>
</html>
