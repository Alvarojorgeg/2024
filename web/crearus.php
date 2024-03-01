<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Fotopiso</title>
    <script>
        function validarFormulario() {
            var nombre = document.forms["registroForm"]["nombre"].value;
            if (nombre.trim() === "") {
                alert("Por favor, ingrese su nombre.");
                return false;
            }

            var correo = document.forms["registroForm"]["correo"].value;
            var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!correoRegex.test(correo)) {
                alert("Por favor, ingrese una dirección de correo electrónico válida.");
                return false;
            }

            var contraseña = document.forms["registroForm"]["pass"].value;
            if (contraseña.length < 8) {
                alert("La contraseña debe tener al menos 8 caracteres.");
                return false;
            }

            var repetirContraseña = document.forms["registroForm"]["rpass"].value;
            if (contraseña !== repetirContraseña) {
                alert("Las contraseñas no coinciden.");
                return false;
            }

            return true;
        }
    </script>
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
            session_start();

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
        <div class="login_3">
            <div class="portada_3">
                <h1 class="portada_7">Crear cuenta</h1>
            </div>
            <div>
                <form name="registroForm" action="crearus2.php" onsubmit="return validarFormulario()">
                    <p>Nombre</p>
                    <input class="portada_6" type="text" name="nombre"> <br><br>
                    
                    <p>Correo</p>
                    <input class="portada_6" type="text" name="correo"> <br><br>

                    <p>Contraseña</p>
                    <input class="portada_6" type="password" name="pass"> <br><br>

                    <p>Repite la contraseña</p>
                    <input class="portada_6" type="password" name="rpass"> <br><br>
                    <select class="portada_6" name="tipo" id="">
                        <option value="comprador" name="comprador">Comprador</option>
                        <option value="vendedor" name="vendedor">Vendedor</option>
                        <option value="admin" name="admin">admin</option>
                    </select><br><br>

                    <input class="portada_5" type="submit" value="Crear">  
                </form>
                
            </div>
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