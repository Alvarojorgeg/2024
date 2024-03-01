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
<div>
<?php
    // Inicia la sesión nuevamente (esto puede no ser necesario si ya se inició al principio)
    session_start();

    // Incluye la información de conexión desde el archivo 'conexion.php'
    include 'conexion.php';

    // Establece la conexión a la base de datos
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Verifica la conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Datos enviados desde el formulario en login.html
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Realiza la consulta SQL
    $stmt = mysqli_prepare($conn, "SELECT * FROM usuario WHERE correo = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verifica si la consulta se realizó correctamente
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Verifica si se encontraron filas
    if ($result && mysqli_num_rows($result) > 0) {
        // Almacena el resultado de la consulta en la variable $row
        $row = mysqli_fetch_assoc($result);

        // Obtiene el hash de la contraseña desde la base de datos
        $hash = $row['clave'];

        // Verifica si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($password, $hash)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['nombres'] = $row['nombres'];
            $_SESSION['tipo'] = $row['tipo_usuario'];
            $_SESSION['id'] = $row['usuario_id'];
            $_SESSION['start'] = time();

            echo "<div class='portada_1'>";
            echo "<div class='cuadrado3'><p class='correcto'>USUARIO CONECTADO:  " . $_SESSION['nombres'] . "</p></div>";
        } else {
            echo "<div class='portada_1'>";
            echo "<div class='cuadrado3'><p class='nohayresultado'>CONTRASEÑA INCORRECTA</p></div>";
            echo "</div>";
        }
    } else {
        // No se encontraron filas o hubo un error
            echo "<div class='portada_1'>";
            echo "<div class='cuadrado3'><p class='nohayresultado'>CONTRASEÑA INCORRECTA</p></div>";
            echo "</div>";
    }
    ?>
</div>
<div class="footer_1">
    <br><br><img src="./img/logo.png" alt="" width="100px" height="70px">
        <a href="index.php"><div class="footer_2"><p class="footer_letra">Inicio</p></div></a>
        <a href="venderpiso.php"><div class="footer_2"><p class="footer_letra">Vender Piso</p></div></a>
        <a href="mispisos.php"><div class="footer_2"><p class="footer_letra">Mis pisos</p></div><br><br></a>
    </div>

</body>
</html>