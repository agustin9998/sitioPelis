<?php
require_once 'datos.php';
session_start();
$usuario = $_SESSION["usuarioLogueado"];
$pendiente = "PENDIENTE";
$comentarios = getComentariosPend($pendiente);
$mySmarty = getSmarty();
$mySmarty->assign("comentarios", $comentarios);
$mySmarty->display('aprobarCom.tpl');
