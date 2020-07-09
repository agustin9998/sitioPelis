<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/pelicula.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/comentarios.js"></script>


        <meta charset="UTF-8">
        <title>{$pelicula.titulo}</title>
    </head>
    <body>
        <br>
        <div id="encabezado">
            <button id="atras" onclick="history.back()"> Atras </button>
            <h1 id="title"> {$pelicula.titulo} </h1>
        </div>
        <br>
        <img id="img" alt="No se encontro imagen" src="img/{$pelicula.id}" width="275" height="450"/>
        <div id="info">
            <p style="text-align: center;">{$genero.nombre}</p>
            <label> Puntuacion {$pelicula.puntuacion}/5<label class="estrella" title="text"></label></label>
        </div>
        <div id="limitacion"><br>---------------------------------------------------------------------------------------<br></div>
        <div id="elenco">
            <h2>Elenco de la pelicula</h2>
            {foreach from=$elenco item=actor}
                <p>{$actor.nombre}</p>    
            {/foreach}<br>
        </div>
        <div id="limitacion"><br>---------------------------------------------------------------------------------------<br></div>
        <div id="trailer">

            <iframe  width="560" height="315" src={$url} frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <br>
        <div id="limitacion"><br>---------------------------------------------------------------------------------------<br></div>
        <input id="idPelicula" type="hidden" name="idPelicula" value={$idPelicula}/>

        <div id="comPag">

        </div>
        <br><br><br>
        <div id="nuevoCom">
            <h1>Ingrese su comentario!</h1>
            <div>
                <form action="registroComentario.php" method="POST">

                    <div class="rate" style="padding-left: 45%;">
                        <input type="radio" id="star5" name="5" value="5" />
                        <label for="star5" title="text"></label>
                        <input type="radio" id="star4" name="4" value="4" />
                        <label for="star4" title="text"></label>
                        <input type="radio" id="star3" name="3" value="3" />
                        <label for="star3" title="text"></label>
                        <input type="radio" id="star2" name="2" value="2" />
                        <label for="star2" title="text"></label>
                        <input type="radio" id="star1" name="1" value="1" />
                        <label for="star1" title="text"></label>
                    </div>
                    <textarea name = "mensaje" id="mensaje" required></textarea>
                    <br>
                    <div id="enviarCom">
                        {if (isset($usuario))}
                            <button type="submit" id="submit" >Enviar</button>
                        {else}
                            <button type="submit" id="submit" disabled >Enviar</button>
                            <label>Debe iniciar sesion para realizar un comentario.</label>

                        {/if}
                    </div>
                </form>
                <br>
                <br>
            </div>
        </div>

    </body>

</html>
