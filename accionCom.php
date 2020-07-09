<?php
require_once 'datos.php';
$estado = $_POST["aprobar"];
$id = $_POST["id"];
$id_pelicula = $_POST["id_pelicula"];
$puntuacion = $_POST["puntuacion"];
if (isset($estado) && $estado == "APROBADO") {
    update($estado, $id-0);
    $p = nuevaP($id_pelicula-0, "APROBADO");
    $c = cantCom($id_pelicula-0,"APROBADO");
    $suma=0.00;
    foreach($p as $i){
    $suma=$suma+($i["puntuacion"]-0);
    }
    $suma=$suma/(($c[0][0])-0);
    updateP($suma, $id_pelicula);
    header('Location: aprobarCom.php');
}else{
    $estado = $_POST["rechazar"];
    update($estado, $id);
    
}

