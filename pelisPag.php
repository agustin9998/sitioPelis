<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

# crear instancia de smarty
$mySmarty = getSmarty();
$catId = 1;
if (isset($_COOKIE["ultimaCategoria"])) {
    $catId = $_COOKIE["ultimaCategoria"];
}
if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
}
$pag = 1;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

$categoria = getCategoria($catId);
if (isset($categoria)) {
    setcookie("ultimaCategoria", $catId, time() + (60 * 60 * 24), "/");
}


$mySmarty->assign("categoria", $categoria);
$mySmarty->assign("peliculas", getPeliculasDeCategoria($catId, $pag,$_GET['busqueda']));
$mySmarty->assign("pagina", $pag);
$mySmarty->assign("paginas", cantidadPaginasCategoria($catId,$_GET['busqueda']));
# mostrar el template
$mySmarty->display('peliPag.tpl');