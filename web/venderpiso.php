<?php
session_start();

if (!isset($_SESSION["nombres"]) || ($_SESSION["tipo"] !== "vendedor" && $_SESSION["tipo"] !== "admin")) {
    // Si no ha iniciado sesión o no es un comprador, vendedor ni administrador, redirigir a la página de acceso
    header("Location: acceder.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Fotopiso</title>
    <script>
        function validarFormulario() {
            var calle = document.getElementById("calle").value;
            var numero = document.getElementById("numero").value;
            var piso = document.getElementById("piso").value;
            var puerta = document.getElementById("puerta").value;
            var cp = document.getElementById("cp").value;
            var metros = document.getElementById("metros").value;
            var zona = document.getElementById("zona").value;
            var precio = document.getElementById("precio").value;
            var foto = document.getElementById("foto").value.toLowerCase();

            if (calle.trim() === "" || numero.trim() === "" || piso.trim() === "" ||
                puerta.trim() === "" || cp.trim() === "" || metros.trim() === "" ||
                zona.trim() === "" || precio.trim() === "") {
                alert("Por favor, complete todos los campos.");
                return false;
            }

            if (!esNumero(numero) || !esNumero(piso) || !esNumero(cp) || !esNumero(metros) || !esNumero(precio)) {
                alert("Los campos numéricos deben contener solo números.");
                return false;
            }

            if (!foto.endsWith(".jpg") && !foto.endsWith(".png")) {
                alert("Por favor, suba una imagen en formato JPG o PNG.");
                return false;
            }

            return true;
        }

        function esNumero(valor) {
            return !isNaN(parseFloat(valor)) && isFinite(valor);
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

    <div class="vender_2">
        <div class="vender_1">
            <div class="portada_3">
                <h1 class="portada_7">Vender piso</h1>
            </div>
            <div>
                <form method="post" action="venderpiso2.php" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                    <p>Calle</p>
                    <input class="portada_6" type="text" id="calle" name="calle"> <br><br>
                    
                    <p>Numero</p>
                    <input class="portada_6" type="text" id="numero" name="numero"> <br><br>

                    <p>Piso</p>
                    <input class="portada_6" type="text" id="piso" name="piso"> <br><br>

                    <p>Puerta</p>
                    <input class="portada_6" type="text" id="puerta" name="puerta"> <br><br>

                    <p>CP</p>
                    <input class="portada_6" type="text" id="cp" name="cp"> <br><br>

                    <p>Metros</p>
                    <input class="portada_6" type="text" id="metros" name="metros"> <br><br>

                    <p>Zona</p>
                    <input class="portada_6" type="text" id="zona" name="zona"> <br><br>

                    <p>Precio</p>
                    <input class="portada_6" type="text" id="precio" name="precio"> <br><br>

                    <p>imagen:</p>
                    <INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="1000002400">
                    <INPUT TYPE="FILE" class="portada_subirimg" id="foto" NAME="foto"></P><br><br>

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
