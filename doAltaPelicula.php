<?php

require_once 'datos.php';
ini_set('display_errors', 1);
$titulo = $_POST["titulo"];
$director = $_POST["director"];
$genero = $_POST["genero"];
$elenco = $_POST["elenco"];
$resumen = $_POST["resumen"];
$fecha = $_POST["fecha"];
$trailer = $_POST["trailer"];
$arrayElenco = explode(";", $elenco);
$imagen = $_FILES["imagen"]["tmp_name"];

altaPelicula($titulo, $director, $genero, $resumen, $fecha, $trailer, $imagen);

$id_pelicula = idPelicula($titulo);
$id = $id_pelicula[0][0];

foreach ($arrayElenco as $actor){
    altaActor($actor, $id);
}

echo'<script type="text/javascript">
    alert("Se registro la pelicula de manera exitosa!");
    window.location.href="index.php";
    </script>';

//function registro($titulo, $director, $elenco) {
//    $cn = abrirConexion();
//    $cn->consulta('INSERT INTO peliculas(titulo, director, elenco) '
//            . 'VALUES(:titulo, :director, :elenco)', array(
//        array("email", $titulo, 'string'),
//        array("usuario", $director, 'string'),
//        array("clave", $elenco, 'string')
//    ));
//}

