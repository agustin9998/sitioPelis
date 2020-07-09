<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="css/alta.css">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/altaPeli.css">
        <title></title>
    </head>
    <body>
        <div id="encabezado">
            <button id="atras" onclick="history.back()"> Atras </button>
            <h1 id="title"> ALTA DE PELICULAS </h1>
        </div>
        <img id="loginico" src="img/alta.png">
        <form action="doAltaPelicula.php" method="POST" enctype="multipart/form-data">
            <div id="campos">
                <label>Titulo:</label> <input id="campos1" name="titulo" type="text" required /><br>
                <label>Director:</label> <input id="campos1" name="director" type="text" required /><br>
                <label>Genero:</label><select id="campos1" name = "genero" required>
                    <option value = 1  selected>Acción</option>
                    <option value = 2 id="2">Aventura</option>
                    <option value = 7 id="7">Ciencia Ficción</option>            
                    <option value = 3 id="3">Comedia</option>
                    <option value = 4 id="4">Drama</option>
                    <option value = 9 id="9">Infantiles</option>
                    <option value = 5 id="5">Musicales</option>
                    <option value = 8 id="8">Suspenso</option>
                    <option value = 6 id="6">Terror</option>
                </select><br>
                <label>Elenco(Agregar a los Actores separados por un ";"):<br></label><input type="text" id="elenco" class="campos2" name="elenco"><br>
                <label>Resumen:</label><br> <textarea name="resumen" id="resumen" class="campos2" required></textarea><br>
                <input type="date" id="fecha" name="fecha" min="1895-01-01" class="campos2" required><br>
                <label>Trailer:</label> <input type="url" name="trailer" id="trailer" class="campos2" required="none"><br>
                <input type="file" accept=".jpg,.png" name="imagen" class="atras" /><br>
                <input id="botonAlta" value="Alta" type="submit"/><br>
            </div>
        </form>
    </body>
</html>