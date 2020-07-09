<?php

require_once 'datos.php';

$email = $_POST["email"];
$clave = $_POST["clave"];

$usuarioLogueado = login($email, $clave)[0];

if (isset($usuarioLogueado)) {
    session_start();
    $_SESSION["usuarioLogueado"] = $usuarioLogueado;
    header('location:index.php');
} else {
    header('location:login.php?err=1');
}