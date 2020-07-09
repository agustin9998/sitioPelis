<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PelisYa.com</title>
        <link rel="stylesheet" type="text/css" href="css/Pelis.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>
        <div id="encabezado">
            <img src="img/logo.png">
            <h3>________________________________</h3>
            <h3 id="slogan"> La mejor guia de peliculas del mundo</h3>
        </div>
        <div id="menu">
            <ul>
                <li><a href="#">Pagina Principal</a></li>

                <li><a href="#">Contacto</a></li>

                {if (isset($usuarioLogueado))}
                    <li>Hola {$usuarioLogueado.alias} <a href="doLogout.php">Salir</a></li>
                    {if $usuarioLogueado.es_administrador==1}
                    <li><a href="altaPeliculas.php">Alta de Peliculas</a></li>
                    <li><a href="aprobarCom.php">Aprobar Comentarios</a></li>
                    {/if}
                    
                {else}
                    <li><a href="login.php">Inicio de Sesion</a></li>
                {/if}
                
                {if !(isset($usuarioLogueado))}
                    <li><a href="registro.php">Registrate</a></li>
                {/if}
                
                
            </ul>
        </div>
        <div id="buscador">
            <label>Ingresa tu busqueda</label>
            <input type="text" id="texto"/>
            <input type="button" value="Buscar" id="buscar"/>
        </div>
        <div id="categorias">
            <h2>Categorias</h2>
            <ul>
                {foreach from=$categorias item=cat}
                    <li>
                        <a href=#" class="categoria" catId="{$cat.id}">
                            {$cat.nombre}
                        </a>
                    </li>
                {/foreach}

            </ul>
        </div>
        <div id="peliculas">
            <h3>{$categoria.nombre}</h3>
            {foreach from=$peliculas item=pelicula}
                {include file="cuadrado_pelicula.tpl" pelicula=$pelicula usuario=$usuario}
            {/foreach}
        </div>
    </body>
</html>