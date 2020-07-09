<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/registro.css">
        <title></title>
    </head>
    <body>
        <div id="encabezado">
            <button id="atras" onclick="history.back()"> Atras </button>
            <h1 id="title"> REGISTRO </h1>
        </div>
        <img id="loginico" src="img/registro.png">
        <form action="doRegistro.php" method="POST">
            <div id="campos">
                Email: <input id="campos1" name="email" type="email"/><br>
                Usuario: <input id="campos1" name="usuario" type="text"/><br>
                Clave: <input id="campos1" name="clave" type="password"/><br>
                <input id="atras" value="Registro" type="submit"/><br>
                <?php
                if (isset($_GET["err"])) {
                    echo("<label>Email en uso, verifique que su clave sea de 6 o mas caracteres.</label>");
                }
                ?>
            </div>
        </form>
    </body>
</html>