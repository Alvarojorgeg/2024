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
    
    <div class=content>
    <div class="separador_1">
        <h2 class="separador_2">Mis pisos</h2>
    </div>
    <?php
   // Conectar con el servidor de base de datos
   $conexion = mysqli_connect("localhost", "root", "rootroot") or die("No se puede conectar con el servidor");

   // Seleccionar base de datos : Use
   mysqli_select_db($conexion, "Inmobiliaria") or die("No se puede seleccionar la base de datos");

   $id=$_SESSION['id'];

   // Enviar consulta
   $instruccion = "select pisos.* from pisos,usuario where pisos.usuario_id=usuario.usuario_id and usuario.usuario_id='$id'";
   $consulta = mysqli_query($conexion, $instruccion) or die("Fallo en la consulta");

   // Mostrar resultados de la consulta
   $nfilas = mysqli_num_rows($consulta);

   if ($nfilas > 0) {
      for ($i = 0; $i < $nfilas; $i++) {
         $resultado = mysqli_fetch_array($consulta);
         print("    <div class='todo_2'>\n");
         print("        <div class='todo_3'>\n");
         // Consultar imagen
         $nombreFichero = $resultado['imagen'];
         $rutaImagen = "./fotocasa/$nombreFichero";
         print("            <img src='$rutaImagen' class='imagen_total' alt='Imagen' width='100px' height='50px'>\n");
         print("        </div>\n");
         print("        <div class='todo_titulo'>\n");
         print("            <p class='todo_5'>" . $resultado['zona'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'> Calle:  " . $resultado['calle'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>Piso:  " . $resultado['piso'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>Puerta:  " . $resultado['puerta'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>C.P:  " . $resultado['cp'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>Metros:  " . $resultado['metros'] . "</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>Número:  " . $resultado['numero'] . " m2</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>Precio:  " . $resultado['precio'] . " €</p>\n");
         print("        </div>\n");
         print("        <div class='todo_4'>\n");
         print("            <p class='todo_5'>ID: " . $resultado['Codigo_piso'] . "</p>\n");
         print("        </div>\n");
         $codigo_piso = $resultado['Codigo_piso'];
         $queryVendido = "SELECT * FROM comprados WHERE Codigo_piso = '$codigo_piso'";
         $resultVendido = mysqli_query($conexion, $queryVendido);
         if (mysqli_num_rows($resultVendido) > 0) {
            print("           <input type='button' value='VENDIDO' class='portada_5ro'>\n");
        } else{

                print("            <input type='button' value='NO VENDIDO' class='comprar'>\n");
        }
        print "<br>";
        print("        <form method='post' action='eliminarpiso.php'>\n");
        print("            <input type='hidden' name='Codigo_piso' value='" . $resultado['Codigo_piso'] . "'>\n");
        print("            <input type='submit' value='ELIMINAR' class='portada_5ro'>\n");
        print("        </form>\n");
          
         print("    </div>\n");
      }
      print("</div>\n");
   } else {
      echo "<div class='cuadrado3'><p class='nohayresultado'>¡ NO HAY RESULTADOS !</p></div>";
   }

   // Cerrar conexión
   mysqli_close($conexion);
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