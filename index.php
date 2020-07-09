<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
# crear instancia de smarty
$mySmarty = getSmarty();

# cargar datos
session_start();
$usuario = $_SESSION["usuarioLogueado"];

$catId = 1;
if (isset($_COOKIE["ultimaCategoria"])) {
    $catId = $_COOKIE["ultimaCategoria"];
}

if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
}

$categoria = getCategoria($catId);
if (isset($categoria)) {
    setcookie("ultimaCategoria", $catId, time() + (60 * 60 * 24), "/");
}

# setear variables
$mySmarty->assign("usuarioLogueado", $usuario);
$mySmarty->assign("categorias", getCategorias());
$mySmarty->assign("categoria", $categoria);
$mySmarty->assign("peliculas", getPeliculasDeCategoria($catId, 1));

# mostrar el template
$mySmarty->display('index.tpl');

