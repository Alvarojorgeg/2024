<?php
session_start();
if (!isset($_SESSION["nombres"]) || ($_SESSION["tipo"] !== "comprador" && $_SESSION["tipo"] !== "vendedor" && $_SESSION["tipo"] !== "admin")) {
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
    $calle = $_REQUEST["calle"];
    $numero = $_REQUEST["numero"];
    $piso = $_REQUEST["piso"];
    $puerta = $_REQUEST["puerta"];
    $cp = $_REQUEST["cp"];
    $metros = $_REQUEST["metros"];
    $zona = $_REQUEST["zona"];
    $precio = $_REQUEST["precio"];
    $imagen = $_REQUEST["imagen"];

        // Si hay errores me los mostrará
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

       // Subir fichero
       $copiarFichero = false;
       $errores = "";

       // Copiar fichero en directorio de ficheros subidos

          if (is_uploaded_file ($_FILES['foto']['tmp_name']))
          {
             $nombreDirectorio = "./fotocasa/";
             $nombreFichero = $_FILES['foto']['name'];
             $copiarFichero = true;
    
          // Si ya existe un fichero con el mismo nombre, renombrarlo
             $nombreCompleto = $nombreDirectorio . $nombreFichero;
             if (is_file($nombreCompleto))
             {
                $idUnico = time();
                $nombreFichero = $idUnico . "-" . $nombreFichero;
             }
          }
       // El fichero introducido supera el límite de tamaño permitido
          else if ($_FILES['foto']['error'] == UPLOAD_ERR_FORM_SIZE)
          {
               $maxsize = $_REQUEST['MAX_FILE_SIZE'];
             $errores = $errores . "   <LI>El tamaño del fichero supera el límite permitido ($maxsize bytes)\n";
          }
       // No se ha introducido ningún fichero
          else if ($_FILES['foto']['name'] == "")
             $nombreFichero = '';
       // El fichero introducido no se ha podido subir
          else
             $errores = $errores . "   <LI>No se ha podido subir el fichero\n";
    
       // Mostrar errores encontrados
          if ($errores != "")
          {
             print ("<P>No se ha podido realizar la inserción debido a los siguientes errores:</P>\n");
             print ("<UL>\n");
             print ($errores);
             print ("</UL>\n");
             print ("<P>[ <A HREF='javascript:history.back()'>Volver</A> ]</P>\n");
          }
          else
          {
    
          // Mover foto a su ubicación definitiva
             if ($copiarFichero)
                move_uploaded_file ($_FILES['foto']['tmp_name'], $nombreDirectorio . $nombreFichero);
          }    

          $id=$_SESSION['id'];
    // Consulta
    $query = "INSERT INTO pisos (calle, numero, piso, puerta, cp, metros, zona, precio, imagen, usuario_id) VALUES ('$calle', '$numero', '$piso', '$puerta', '$cp', '$metros', '$zona', '$precio', '$nombreFichero', '$id')";

    if (mysqli_query($conn, $query)) {
      echo "<div class='portada_1'>";
      echo "<div class='cuadrado3'><p class='correcto'>PISO PUBLICADO</p></div>";
      echo "</div>";
    } else {
      echo "<div class='portada_1'>";
      echo "<div class='cuadrado3'><p class='nohayresultado'>ERROR AL PUBLICAR</p></div>"  . mysqli_error($conn);
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
