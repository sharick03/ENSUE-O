<?php
require_once('../MODELOS/login.php');
require_once("../MODELOS/conexion.php");

$DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
$consulta = $DBH->prepare("SELECT * FROM Novedad");
$consulta->execute();
$novedades = $consulta->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="Dashboard.php">Volver</a>
            <a href="RegistroNovedad.php">Nuevo Registro</a>
        </nav>
    </header>
    <section>
        <h1 class="heading">Novedades</h1>
        <?php
        foreach ($novedades as $novedad) {
            ?>
            <div class="card">
                <h2><?php echo $novedad['fecha']; ?></h2>
                <p><?php echo $novedad['descripcion']; ?></p>
                <button class="delete-button" onclick="marcarResuelto(this)">Resuelto</button>
                <i class="chulo">&#10004;</i>
            </div>
            <?php
        }
        ?>
    </section>

    <script>
        function marcarResuelto(button) {
            if (confirm("¿Estás seguro de que deseas marcar esta novedad como resuelta?")) {
                button.style.display = "none"; // Oculta el botón
                button.nextElementSibling.style.display = "inline"; // Muestra el chulo
            }
        }
    </script>
</body>
</html>
