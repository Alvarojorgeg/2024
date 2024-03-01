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
    $dbname = "inmobiliaria";

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Datos
    $nombre = $_REQUEST["nombre"];
    $correo = $_REQUEST["correo"];
    $pass = $_REQUEST["pass"];
    $rpass = $_REQUEST["rpass"];
    $tipo = $_REQUEST["tipo"];

    // Verificar si el usuario ya existe
    $checkQuery = "SELECT usuario_id FROM usuario WHERE nombres = ? OR correo = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "ss", $nombre, $correo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<div class='portada_1'>";
        echo "<div class='cuadrado3'><p class='nohayresultado'>EL NOMBRE O CORREO YA EXISTE</p></div>";
        echo "</div>";
    } else {
        // Hash de la contraseña
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        // Consulta preparada para la inserción
        $query = "INSERT INTO usuario (nombres, correo, clave, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $correo, $passHash, $tipo);

        // Ejecutar la consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='portada_1'>";
            echo "<div class='cuadrado3'><p class='correcto'>USUARIO CREADO</p></div>";
            echo "</div>";
        } else {
            echo "<div class='portada_1'>";
            echo "<div class='cuadrado3'><p class='nohayresultado'>ERROR AL CREAR</p></div>" . mysqli_error($conn);
            echo "</div>";
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
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
