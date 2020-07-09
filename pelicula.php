<!DOCTYPE html>
<?php
require_once 'datos.php';
require_once 'libs/Smarty.class.php';
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
# Cargar datos
session_start();
$usuario = $_SESSION["usuarioLogueado"];
$prodId = 1;
if (isset($_GET["id"])) {
    $prodId = $_GET["id"];
}
$aprobado = "APROBADO";
$pelicula = getPelicula($prodId);

$elenco = getElenco($pelicula["id"]);
$url = "https://www.youtube.com/embed/" . explode("=", $pelicula["youtube_trailer"])[1];


if (isset($pelicula)) {
    # Crear una instancia de Smarty
    $mySmarty = getSmarty();
    
    # asignar valores a las variables
    $mySmarty->assign("url", $url);
    $mySmarty->assign("pelicula", $pelicula);
    $mySmarty->assign("comentarios", getComentarios($prodId,$aprobado,1));
    $mySmarty->assign("usuario",$usuario);
    $mySmarty->assign("elenco", $elenco);
    $mySmarty->assign("genero", getCategoria($pelicula["id_genero"]));
    $mySmarty->assign("idPelicula", $prodId);
    # mostrar el template
    $mySmarty->display('pelicula.tpl');
}
                   
       
