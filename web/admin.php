<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Administración</title>
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
                <img class="header_33" src="./img/personal.png" width="40px" height="40px" alt="">
            </a>
        </div>
    </div>
</div>

<div class="content">
    <div class="separador_1">
        <h2 class="separador_2">Pisos</h2>
    </div>

    <?php
    // Conectar con el servidor de base de datos
    $conexion = mysqli_connect("localhost", "root", "rootroot") or die("No se puede conectar con el servidor");

    // Seleccionar base de datos : Use
    mysqli_select_db($conexion, "Inmobiliaria") or die("No se puede seleccionar la base de datos");

    $id = $_SESSION['id'];

    // Consulta pisos
    $instruccion = "select * from pisos;";
    $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta");
    // Consulta de usuarios
    $consulta_usuarios = "SELECT * FROM usuario;";
    $resultado_usuarios = mysqli_query($conexion, $consulta_usuarios) or die("Fallo en la consulta de usuarios");

    // Mostrar resultados de la consulta
    $nfilas = mysqli_num_rows($consulta);

    if ($nfilas > 0) {
        echo "<table>";
        echo "<tr>
                <th>Imagen</th>
                <th>Zona</th>
                <th>Calle</th>
                <th>Piso</th>
                <th>Puerta</th>
                <th>C.P</th>
                <th>Metros</th>
                <th>Número</th>
                <th>Precio</th>
                <th>ID</th>
                <th>Acción</th>
              </tr>";

        for ($i = 0; $i < $nfilas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            echo "<tr>";
            echo "<td><img src='./fotocasa/{$resultado['imagen']}' alt='Imagen' class='table-image'></td>";
            echo "<td>{$resultado['zona']}</td>";
            echo "<td>{$resultado['calle']}</td>";
            echo "<td>{$resultado['piso']}</td>";
            echo "<td>{$resultado['puerta']}</td>";
            echo "<td>{$resultado['cp']}</td>";
            echo "<td>{$resultado['metros']}</td>";
            echo "<td>{$resultado['numero']} m2</td>";
            echo "<td>{$resultado['precio']} €</td>";
            echo "<td>{$resultado['Codigo_piso']}</td>";
            echo "<td>
            <form method='post' action='eliminarpiso.php'>
                <input type='hidden' name='Codigo_piso' value='{$resultado['Codigo_piso']}'>
                <input type='submit' value='ELIMINAR' class='portada_5ro'>
            </form>
          </td>";
          echo "</tr>";
            }

            echo "</table>";
            } else {
            echo "<div class='cuadrado3'><p class='nohayresultado'>¡ NO HAY RESULTADOS !</p></div>";
            }
    $nfilas_usuarios = mysqli_num_rows($resultado_usuarios);

    if ($nfilas_usuarios > 0) {
        echo "<h2 class='separador_2'>Usuarios</h2>";
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Tipo de Usuario</th>
                <th>Accion</th>
                </tr>";
    
        for ($i = 0; $i < $nfilas_usuarios; $i++) {
            $resultado_usuario = mysqli_fetch_array($resultado_usuarios);
            echo "<tr>";
            echo "<td>{$resultado_usuario['usuario_id']}</td>";
            echo "<td>{$resultado_usuario['nombres']}</td>";
            echo "<td>{$resultado_usuario['correo']}</td>";
            echo "<td>{$resultado_usuario['tipo_usuario']}</td>";
            echo "<td>
            <form method='post' action='eliminarcuentaadmin.php'>
                <input type='hidden' name='userid' value='{$resultado_usuario['usuario_id']}'>
                <input type='submit' value='ELIMINAR' class='portada_5ro'>
            </form>
          </td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "<div class='cuadrado3'><p class='nohayresultado'>¡ NO HAY RESULTADOS DE USUARIOS !</p></div>";
    }
    // Cerrar conexión
    mysqli_close($conexion);
    ?>
</div>

<div class="footer_1">
    <br><br><img src="./img/logo.png" alt="" width="100px" height="70px">
    <a href="index.php"><div class="footer_2"><p class="footer_letra">Inicio</p></div></a>
    <a href="venderpiso.php"><div class="footer_2"><p class="footer_letra">Vender Piso</p></div></a>
    <a href="mispisos.php"><div class="footer_2"><p class="footer
