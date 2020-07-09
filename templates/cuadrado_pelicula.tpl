    
<link rel="stylesheet" type="text/css" href="css/cuadrado.css">
<a style="display: block" href="pelicula.php?id={$pelicula.id}">
<div class="pelicula" id="cuadradoPelicula" >
    <img id="img" alt="No se encontro imagen" src="img/{$pelicula.id}" width="125" height="185"/>
        <span class="nombre-producto" id="nombreProd" >{$pelicula.titulo}</span><br><br>
        <span class="precio-producto">{$pelicula.puntuacion}/5<label class="estrella" title="text"></label></span>
</div>
</a>