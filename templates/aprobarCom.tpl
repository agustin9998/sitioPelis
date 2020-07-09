<!DOCTYPE html>

<html>
    <link rel="stylesheet" type="text/css" href="css/aprobarCom.css">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="encabezado">
            <button id="atras" onclick="history.back()"> Atras </button>
            <h1 id="title"> APROBACION DE COMENTARIOS </h1>
        </div>
        <img id="loginico" src="img/comentario.png">
        {if $comentarios !=null}
            {foreach from=$comentarios item=comentario}
                <div id="cuadradoComentario">
                    {$comentario.mensaje}
                    {$comentario.id_pelicula}
                    {$comentario.id_usuario}
                    {$comentario.puntuacion}
                    <form action="accionCom.php" method="POST">
                        <div id="campos">
                            <button type="submit" class="atras" id="aprobar" name="aprobar" value="APROBADO">Aprobar</button>
                            <button type="submit" class="atras" id="rechazar" name="rechazar" value="RECHAZADO">Rechazar</button>
                            <input type="hidden" name="id" value={$comentario.id}>
                            <input type="hidden" name="puntuacion" value={$comentario.puntuacion}>
                            <input type="hidden" name="id_pelicula" value={$comentario.id_pelicula}>
                        </div>
                    </form>
                </div>
                <br>
            {/foreach}
        {/if}
        {if $comentarios==null}
            <label id="campos">No hay comentarios pendientes!</label>
        {/if}
</body>

</html>
