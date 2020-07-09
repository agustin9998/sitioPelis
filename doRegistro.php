<?php

require_once 'datos.php';
require_once 'class.Conexion.BD.php';
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
$email = $_POST["email"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$respuesta = esta($email)[0];
$cero = 0;
if (isset($respuesta)) {

    header('location:registro.php?err=1');
} else {
    registro($email, $usuario, $clave);
    echo'<script type="text/javascript">
    alert("Registro exitoso! Ahora ya puede iniciar sesion");
    window.location.href="index.php";
    </script>';
}