
<link rel="stylesheet" type="text/css" href="css/coment.css">
{foreach from=$comentarios item=comentario}
    <div id="paginado">
        <ul>
            <li><h1 id="usuario">{$comentario.id_usuario}:&emsp; </h1> <h2 id="coment">{$comentario.mensaje}</h2></li>
            <li><h2 id="puntuacion">{$comentario.puntuacion}/5.00★</h2></li>
        </ul>
    </div>
{/foreach}
<div id="paginacion">
    <button style="float: right;" id="siguiente" name="siguiente" {if ($pagina>=$paginas)}disabled{/if}>Siguiente</button>
    <div style="float: right;"> Pagina {$pagina} de {$paginas}</div>
    <button style="float: right;" id="anterior" name="anterior" {if ($pagina<=1)}disabled{/if}>Anterior</button>
</div>
