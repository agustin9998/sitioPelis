<?php

require_once 'libs/Smarty.class.php';
require_once 'class.Conexion.BD.php';

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
/*
 * Todas las funciones en este archivo devuelven datos.
 * Por ahora son datos "harcoded", pero en el futuro las vamos 
 * a cambiar para que hagan consultas a la base de datos. 
 *  */

function abrirConexion() {
    $cn = new ConexionBD("mysql", "localhost", "sitioPelis", "root", "root");
    $cn->conectar();
    return $cn;
}

function getCategorias() {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM generos ORDER BY nombre');
    return $cn->restantesRegistros();
}

function getCategoria($id) {
    $cn = abrirConexion();
    $cn->consulta('SELECT id, nombre FROM generos WHERE id=:id', array(
        array("id", $id, 'int')
    ));
    return $cn->siguienteRegistro();
}

function getComentarios($id_pelicula, $estado, $pagina) {
    $tamano = 5;
    $offset = ($pagina - 1) * $tamano;
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM comentarios WHERE id_pelicula=:id_pelicula AND estado=:estado LIMIT :offset, :tamano', array(
        array("id_pelicula", $id_pelicula, 'int'), 
        array("estado", $estado, 'string'),
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int')
        ));
    return $cn->restantesRegistros();
}

function getComentariosPend($aprobado) {
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM comentarios WHERE estado=:aprobado', array(array("aprobado", $aprobado, 'string')));
    return $cn->restantesRegistros();
}

function getPeliculasDeCategoria($id_genero, $pagina, $filtro = "") {
    $tamano = 6;
    $offset = ($pagina - 1) * $tamano;
    $filtro = '%' . $filtro . '%';
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM peliculas '
            . 'WHERE id_genero = :id_genero AND titulo LIKE :filtro '
            . 'LIMIT :offset, :tamano', array(
        array("id_genero", $id_genero, 'int'),
        array("offset", $offset, 'int'),
        array("tamano", $tamano, 'int'),
        array("filtro", $filtro, 'string')
    ));
    return $cn->restantesRegistros();
}

function getPelicula($id) {
    $cn = abrirConexion();
    $cn->consulta('SELECT * FROM peliculas WHERE id=:id'
            , array(
        array("id", $id, 'int'),
    ));
    return $cn->siguienteRegistro();
}

function esta($email) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT email FROM usuarios '
            . 'WHERE email = :email', array(array("email", $email, 'string')));
    return $cn->restantesRegistros();
}

function registro($email, $usuario, $clave) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO usuarios(email, alias, password) '
            . 'VALUES(:email, :usuario, :clave)', array(
        array("email", $email, 'string'),
        array("usuario", $usuario, 'string'),
        array("clave", md5($clave), 'string')
    ));
}

function login($email, $password) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT id, email, alias, password, es_administrador FROM usuarios '
            . 'WHERE email = :email AND password = :password', array(
        array("email", $email, 'string'),
        array("password", md5($password), 'string')
    ));
    return $cn->restantesRegistros();
}

function getSmarty() {
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'templates';
    $mySmarty->compile_dir = 'templates_c';
    $mySmarty->config_dir = 'config';
    $mySmarty->cache_dir = 'cache';
    return $mySmarty;
}

function cantidadPaginasCategoria($id_genero, $filtro = "") {
    $filtro = '%' . $filtro . '%';
    $tamano = 6;
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT count(*) as total FROM peliculas WHERE id_genero = :id_genero AND titulo LIKE :filtro ', array(
        array("id_genero", $id_genero, 'int'),
        array("filtro", $filtro, 'string')
    ));

    $fila = $cn->siguienteRegistro();
    $total = $fila["total"];
    $paginas = ceil($total / $tamano);
    if ($paginas == 0) {
        $paginas = 1;
    };
    return $paginas;
}

function cantidadPaginasComentario($id_pelicula, $estado) {
    $tamano = 5;
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT count(*) as total FROM comentarios WHERE id_pelicula = :id_pelicula AND estado =:estado ', array(
        array("id_pelicula", $id_pelicula, 'int'),
        array("estado", $estado, 'string')
    ));

    $fila = $cn->siguienteRegistro();
    $total = $fila["total"];
    $paginas = ceil($total / $tamano);
    if ($paginas == 0) {
        $paginas = 1;
    };
    return $paginas;
}

function altaPelicula($titulo, $director, $genero, $resumen, $fecha, $trailer, $imagen) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO peliculas(titulo, director, id_genero, resumen, fecha_lanzamiento, youtube_trailer) '
            . 'VALUES(:titulo, :director, :genero, :resumen, :fecha, :trailer)', array(
        array("titulo", $titulo, 'string'),
        array("director", $director, 'string'),
        array("genero", $genero, 'int'),
        array("resumen", $resumen, 'string'),
        array("fecha", $fecha, 'string'),
        array("trailer", $trailer, 'string')
    ));
     $id = $cn->ultimoIdInsert();
    if (is_uploaded_file($imagen)) {
        move_uploaded_file($imagen, "img/" . $id);
    }
}

function registrarCom($mensaje, $puntuacion, $id_usuario, $estado, $id_pelicula) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO comentarios(mensaje, puntuacion, id_usuario, estado, id_pelicula) '
            . 'VALUES(:mensaje, :puntuacion, :id_usuario, :estado, :id_pelicula)', array(
        array("mensaje", $mensaje, 'string'),
        array("puntuacion", $puntuacion, 'int'),
        array("id_usuario", $id_usuario, 'int'),
        array("estado", $estado, 'string'),
        array("id_pelicula", $id_pelicula, 'int')
    ));
}

function comento($id_usuario, $id_pelicula) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT id_usuario, id_pelicula FROM comentarios '
            . 'WHERE id_usuario = :id_usuario AND id_pelicula = :id_pelicula', array(
        array("id_usuario", $id_usuario, 'int'),
        array("id_pelicula", $id_pelicula, 'int')
    ));
    return $cn->restantesRegistros();
}

function update($estado, $id) {
    $cn = abrirConexion();
    $cn->consulta(
            'UPDATE comentarios '
            . 'SET estado = :estado WHERE id=:id', array(
        array("id", $id, 'int'),
        array("estado", $estado, 'string')
    ));
}

function idPelicula($titulo) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT * FROM peliculas '
            . 'WHERE titulo = :titulo', array(
        array("titulo", $titulo, 'string')
    ));
    return $cn->restantesRegistros();
}

function altaActor($nombre, $id_pelicula) {
    $cn = abrirConexion();
    $cn->consulta('INSERT INTO elencos(id_pelicula, nombre) '
            . 'VALUES(:id_pelicula, :nombre)', array(
        array("id_pelicula", $id_pelicula, 'int'),
        array("nombre", $nombre, 'string')
    ));
}

function getElenco($id_pelicula) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT nombre FROM elencos '
            . 'WHERE id_pelicula = :id_pelicula', array(
        array("id_pelicula", $id_pelicula, 'int')
    ));
    return $cn->restantesRegistros();
}

function nuevaP($id_pelicula, $estado) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT puntuacion FROM comentarios '
            . 'WHERE id_pelicula = :id_pelicula AND estado=:estado', array(
        array("id_pelicula", $id_pelicula, 'int'),
        array("estado", $estado, 'string')
    ));
    return $cn->restantesRegistros();
}

function cantCom($id_pelicula, $estado) {
    $cn = abrirConexion();
    $cn->consulta(
            'SELECT count(puntuacion) FROM comentarios '
            . 'WHERE id_pelicula = :id_pelicula AND estado=:estado', array(
        array("id_pelicula", $id_pelicula, 'int'),
        array("estado", $estado, 'string')
    ));
    return $cn->restantesRegistros();
}
function updateP($puntuacion, $id) {
    $cn = abrirConexion();
    $cn->consulta(
            'UPDATE peliculas SET puntuacion = :puntuacion WHERE id=:id', array(
        array("id", $id, 'int'),
        array("puntuacion", $puntuacion, 'float')
    ));
}