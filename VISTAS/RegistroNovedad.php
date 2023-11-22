<?php
require_once('../MODELOS/login.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../MODELOS/conexion.php");
    $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");

    $descripcion = $_POST['descripcion'];
    $fecha = gmdate("Y-m-d");

    $consulta = $DBH->prepare("INSERT INTO Novedad (id_usuario, fecha, descripcion) VALUES (:id_usuario, :fecha, :descripcion)");
    $consulta->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $consulta->bindParam(':fecha', $fecha);
    $consulta->bindParam(':descripcion', $descripcion);

    if ($consulta->execute()) {
        header('Location: ../VISTAS/Novedades.php');
        exit();
    } else {
        echo "Error al guardar la novedad";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="img/Logo.png">
    <title>MISELANEA Y PAPELERIA ENSUEÑO</title>
</head>
<body>
    <header>
        <a class="logo"><?php echo $_SESSION['nombreUsuario']; ?></a>
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="fa fa-bars"></label>
        <nav class="navbar">
            <a href="Novedades.php">Volver</a>
        </nav>
    </header>
    <section class="formulario" id="formulario">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <h1 class="heading">Registrar Novedad</h1>
            <div class="inputcaja"><br>
                <input type="String" step="0.01" name="descripcion" required="true">
                <label for="descripcion">descripcion</label>
            </div>
            <div class="inputcaja"><br>
                <div class="inputcaja">
                    <p>Fecha: <?php echo gmdate("d-m-Y"); ?></p>
                </div><br><br>
                <button type="submit" class="btn">GUARDAR</button>
            </form>
        </section>
    </body>
</html>
