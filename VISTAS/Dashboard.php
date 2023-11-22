<?php
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="img/Logo.png">
    <title>MISCELANEA Y PAPELERIA ENSUEÑO</title>
</head>
<body>
    <header>
        <a class="logo">Bienvenido <?php echo $_SESSION['nombreUsuario']; ?></a>
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="fa fa-bars"></label>
            <nav class="navbar">
                <a href="Usuario.php">Usuarios Registrados</a>
                <a href="../Login.php">Salir</a>
            </nav>
    </header>
    <section class="especificaciones" id="especificaciones">
        <div class="caja-contenedor">
            <div class="caja">
                <img src="img/bancos.png" alt="imagen de bancos ">
                <h3>Bancos</h3>
                <p>Aquí puede ver los bancos que tiene registrados</p>
                <a href="Banco.php" class="btn">Consultar</a>
            </div>
            <div class="caja">
                <img src="img/saldos.png" alt="imagen de saldos">
                <h3>Saldos</h3>
                <p>Aquí puede ver los saldos que tiene cada banco registrado</p>
                <a href="Saldo.php" class="btn">Consultar</a>
            </div>
            <div class="caja">
                <img src="img/novedades.png" alt="imagen de saldos">
                <h3>Novedades</h3>
                <p>Aquí puede realizar las novedades</p>
                <a href="Novedades.php" class="btn">Consultar</a>
            </div>
            <div class="caja">
                <img src="img/transacciones.png" alt="imagen de saldos">
                <h3>Transacciones</h3>
                <p>Aquí puede ver las transacciones que has realizado</p>
                <a href="Transacciones.php" class="btn">Consultar</a>
            </div>
        </div>
</section>
</body>
</html>