<?php
ini_set('display_errors', 1);
require_once 'datos.php';
require_once 'libs/Smarty.class.php';


if (isset($_GET["id_pelicula"])) {
    $id_pelicula = $_GET["id_pelicula"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$mySmarty = getSmarty();
$comentarios = getComentarios($id_pelicula-0, "APROBADO",$pagina-0);
$comentario = $comentarios[0];
$mySmarty->assign("comentarios", $comentarios);
$mySmarty->assign("pagina", $pagina);
$mySmarty->assign("paginas", cantidadPaginasComentario($id_pelicula,"APROBADO"));
//$mySmarty->assign("pelicula", $id_pelicula);
# mostrar el template
$mySmarty->display('comentarioPag.tpl');