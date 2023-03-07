<?php

ini_set('display_errors',true);
error_reporting(E_ALL);


require_once "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

$usuario = $_SESSION['user'];
$db = new DB();


if (isset($_POST['verCategorias'])) {
    $listaCategorias = $db->dime_categorias();
    $msjCategorias = "<table>";
    $msjCategorias.="<tr><th>Nombre categoría</th><th>Código</th></tr>";
    foreach ($listaCategorias as $productos) {
        $msjCategorias .= "<tr><td>$productos[nombre]</td><td>$productos[cod]</td></tr>\n";
    }
    $msjCategorias.="</table>";
}else if (isset($_POST['ocultarCategorias'])){
    $msjCategorias="Has ocultado las categorías<br>";
}


if (isset($_POST['verProductos'])){
    $listaProductos=$db->dime_productos();
    $msjProductos="<table>";
    $msjProductos.="<tr><th>ÍndiceProducto</th><th>Nombre corto</th><th>Familia</th><th>Código</th>
<th>Precio</th><th>Descripción</th></tr>";
    foreach ($listaProductos as $indice=>$valor){
        $msjProductos.="<tr><td>$indice</td><td>$valor[nombre_corto]</td><td>$valor[familia]</td>
<td>$valor[cod]</td><td>$valor[PVP]</td><td>$valor[descripcion]</td></tr>";
    }
    $msjProductos.="</table>";
}else if (isset($_POST['ocultarProductos'])){
    $msjProductos="Has ocultado la lista de productos<br>";
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table{
            padding-left:1rem;
            border: 1px solid black;
            border-collapse: collapse;
        }
        td,th,tr{
            border: 1px solid black;
            padding:1rem;
        }
        button[type=submit] {
            padding:5px 15px 10px 10px;
            background:#ccc;
            border:2rem;
            cursor:pointer;
            border-radius: 5px;
            margin: 1em;
            font-size: 1em;
        }
    </style>
    <title>Sitio.php</title>
</head>
<body>
<h1>Bienvenido a este sitio web <?= $usuario ?></h1>
<form action="listado.php" method="post">
    <button type="submit" name="verCategorias">Ver categorías</button>
    <button type="submit" name="ocultarCategorias">Ocultar categorías</button><br>
    <?= $msjCategorias??"" ?>

    <button type="submit" name="verProductos">Ver todos los productos</button>
    <button type="submit" name="ocultarProductos">Ocultar lista de productos</button><br>
    <?= $msjProductos??"" ?>

</form>
</body>
</html>