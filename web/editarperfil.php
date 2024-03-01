<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Fotopiso</title>
</head>
<body>
    <div class="header_1">
        <div class="header_2">
            <a href="index.php"><img src="./img/logo.png" alt="" width="100px" height="70px"></a>
        </div>
        
        <div>
            <a class="header_3" href="index.php">Inicio</a>
            <a class="header_3" href="mispisos.php">Mis pisos</a>
            <a class="header_3" href="venderpiso.php">Vender piso</a>
            <a class="header_3" href="miscompras.php">Comprados</a>
            <?php
            if (isset($_SESSION["nombres"]) && $_SESSION["tipo"] === "admin") {
                echo '<a class="header_admin" href="admin.php">Administración</a>';
            }
            ?>
            <div class="header_a333">
                <?php
                    echo "<p class='miperfil'>" . $_SESSION['nombres'] . "</p>";
                ?>
                <a href="<?php echo isset($_SESSION["nombres"]) ? './editarperfil.php' : './acceder.php'; ?>">
                <img class="header_33" src="./img/personal.png" width="40px" height="40px" alt=""></a>
            </div>
        </div>
    </div>

    <div class="portada_1">
        <div class="login_4">
            <div class="portada_3">
                <h1 class="portada_7">Mi perfil</h1>
            </div>
            <div>
                <form action="actualizar.php" method="post">
                    <p>Cambiar usuario</p>
                    <input class="portada_6" type="text" name="user" id="" required><br><br>
                    <p>Cambiar Email</p>
                    <input class="portada_6" type="email" name="email" id="" required><br><br>
                    <p>Cambiar contraseña</p>
                    <input class="portada_6" type="password" name="password" id="" minlength="8" required><br><br>
                    <p>Cambiar tipo de usuario</p>
                    <select class="portada_6" name="tipo" id="">
                        <option value="comprador" name="comprador">Comprador</option>
                        <option value="vendedor" name="vendedor">Vendedor</option>
                    </select><br><br>

                    <input class="portada_5" type="submit" value="Actualizar">  
                </form>
            </div>
            <br><a href="cerrarsesion.php"><input class="portada_5ro" type="button" value="Cerrar sesión"></a><br>
            <br><a href="eliminarcuenta.php"><input class="portada_5ro" type="button" value="Borrar cuenta"></a>  
        </div>
    </div>

    <div class="footer_1">
        <br><br><img src="./img/logo.png" alt="" width="100px" height="70px">
        <a href="index.php"><div class="footer_2"><p class="footer_letra">Inicio</p></div></a>
        <a href="venderpiso.php"><div class="footer_2"><p class="footer_letra">Vender Piso</p></div></a>
        <a href="mispisos.php"><div class="footer_2"><p class="footer_letra">Mis pisos</p></div><br><br></a>
    </div>
</body>
</html>
