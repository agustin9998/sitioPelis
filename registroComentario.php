<?php

require_once 'datos.php';
//ini_set('display_errors', 1);
session_start();
$usuario = $_SESSION["usuarioLogueado"]["id"];

$mensaje = $_POST["mensaje"];
$value = "0";
for ($i = 5; $i > 0; $i--) {
    if ($_POST[$i] > $value) {
        $value = $_POST[$i];
    }
}
$pelicula = $_POST["peli"];
$estado = "PENDIENTE";
$hay = comento($usuario, $pelicula)[0];

if (isset($hay)) {
    echo'<script type="text/javascript">
    alert("Ya tiene un comentario pendiente/aprobado en esta pelicula.");
    window.history.back();
    </script>';
} else {
    registrarCom($mensaje, $value - 0, $usuario - 0, $estado, $pelicula - 0);
    
    echo'<script type="text/javascript">
    alert("Comentario enviado con exito! Luego de ser aprobado sera publicado");
    window.location.href="index.php";
    </script>';
}

