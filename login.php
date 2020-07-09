<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <title></title>
    </head>
    <body>
        <div id="encabezado">
            <button id="atras" onclick="history.back()"> Atras </button>
            <h1 id="title"> LOGIN </h1>
        </div>
        <img id="loginico" src="img/login_icon.png">
        <form action="doLogin.php" method="POST">
            <div id="campos">
                Email: <input id="campos1" name="email" type="email"/><br>
                Clave: <input id="campos1" name="clave" type="password"/><br>
                <input id="atras" value="Login" type="submit"/><br>
                <?php
                if (isset($_GET["err"])) {
                    if ($_GET["err"] == 1) {
                        echo("<label>Usuario/clave incorrectos.</label>");
                    }
                    if ($_GET["err"] == 2) {
                        echo("<label>Se ha registrado correctamente, porfavor inicie sesion.</label>");
                    }
                }
                ?>
            </div>
        </form>
    </body>
</html>
