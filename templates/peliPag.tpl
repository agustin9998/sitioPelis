<link rel="stylesheet" type="text/css" href="css/paginacion.css">
<h3>{$categoria.nombre}</h3>

{foreach from=$peliculas item=pelicula}
    <div id="pelicula">{include file="cuadrado_pelicula.tpl" pelicula=$pelicula}</div>
{/foreach}
<div id="paginacion">
    <button id="anterior" {if ($pagina<=1)}disabled{/if}>Anterior</button>
    Pagina {$pagina} de {$paginas}
    <button id="siguiente" {if ($pagina>=$paginas)}disabled{/if}>Siguiente</button>
</div>
