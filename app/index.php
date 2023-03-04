<?php

/*require_once "conexion.php";
echo "-".DSN."-<br>";
try {
    $conexion = new PDO(DSN,USER,PASS);
    foreach($conexion->query('SELECT * from familia') as $fila) {
        print_r($fila);
        echo "<br>";
    }
    $conexion = null;
} catch (PDOException $e) {
    die("No se ha podido conectar ".$e->getMessage())."<br>";
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}*/

//$conexion = new PDO(DSN,USER,PASS);



/*try {
    $conexion_msqli = new mysqli('127.0.0.1', USER, PASS, 'dwes', 23307);
} catch (mysqli_sql_exception $exception) {
    die("No se ha podido conectar ".$exception->getMessage())."<br>";
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
var_dump($conexion_msqli);*/

//create table usuarios(nombre varchar(30),pass varchar(200));
//insert into usuarios values ('dews','abc123.')




/*echo "-".DSN."-<br>";
try {
    $conexion = new PDO(DSN,USER,PASS);
    foreach($conexion->query('SELECT * from familia') as $fila) {
        print_r($fila);
        echo "<br>";
    }
    $conexion = null;
} catch (PDOException $e) {
    die("No se ha podido conectar ".$e->getMessage())."<br>";
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
var_dump($conexion);*/

require_once "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

if (isset($_POST['submit'])){
    //Conecto a la base de datos
    $db = new DB();

    //Leo valores del formulario
    $user=$_POST['nombre'];
    $pass=$_POST['pass'];
    var_dump($_POST);
    if ($db->valida_usuario($user,$pass)){
        $_SESSION['user']=$user;
        header('location:listado.php');
        exit();
    }else{
        $msj= "Datos incorrectos<br>";
    }
}

//https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/practica_mysqli
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
    <fieldset>
    <legend>Datos de conexión</legend>
        <span style="color=red"><?= $msj ?? "" ?></span>
    Nombre<input type="text" name="nombre" id=""><br>
    Pass<input type="text" name="pass" id=""><br>
    <input type="submit" value="Validar" name="submit">
    </fieldset>
</form>

</body>
</html>
