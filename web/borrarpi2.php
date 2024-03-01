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
<?php
    // Configuración de la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "Inmobiliaria";

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    // Datos
    $id = $_REQUEST["id"];

    // Consulta
    $query = "DELETE FROM pisos WHERE codigo_piso='$id';";

    if (mysqli_query($conn, $query)) {
        echo "<div class='portada_1'>";
        echo "<div class='cuadrado3'><p class='correcto'>DATOS BORRADOS</p></div>";
        echo "</div>";
    } else {
        echo "<div class='portada_1'>";
        echo "<div class='cuadrado3'><p class='nohayresultado'>ERROR AL BORRAR</p></div>"  . mysqli_error($conn);
        echo "</div>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>
    <div class="footer_1">
    <br><br><img src="./img/logo.png" alt="" width="100px" height="70px">
        <a href="index.php"><div class="footer_2"><p class="footer_letra">Inicio</p></div></a>
        <a href="venderpiso.php"><div class="footer_2"><p class="footer_letra">Vender Piso</p></div></a>
        <a href="mispisos.php"><div class="footer_2"><p class="footer_letra">Mis pisos</p></div><br><br></a>
    </div>
</body>
</html>