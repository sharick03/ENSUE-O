<?php
require_once('../MODELOS/transaccion.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$ModeloTransaccion=new Transaccion();
$model = new Transaccion();
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
                <a href="RegistroTransaccion.php">Nuevo Registro</a>
                <a href="Reporte.php">Generar Reporte</a>
                <a href="Dashboard.php">Volver</a>
            </nav>
    </header>
    <section>
        <h1 class="heading">Listado de Transacciones</h1>
        <table>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Tipo de transacción </th>
                <th>Valor transacción</th>
                <th>Fecha transacción</th>
            </tr>
            <tbody>
                <?php
                    //Conexion de la bd
                    require_once("../MODELOS/conexion.php");
                    //Consulta
                    $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
                    $STH = $DBH->prepare("SELECT * FROM Transaccion INNER JOIN Usuario ON Transaccion.id_usuario = Usuario.id_usuario");
                    $STH->execute();
                    while ($resultado = $STH->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $resultado['id_transaccion']; ?></td>
                            <td><?php echo $resultado['nombreUsuario'] ?></td>
                            <td><?php echo $resultado['tipo_transaccion']; ?></td>
                            <td><?php echo $resultado['valor_transaccion']; ?></td>
                            <td><?php echo $resultado['fecha']; ?></td>
                        </tr>
                    <?php
                    }
                ?>
        </tbody>
        </table>
    </section>
</body>
</html>