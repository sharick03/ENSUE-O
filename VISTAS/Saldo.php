<?php
require_once('../MODELOS/saldo.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$ModeloSaldo=new Saldo();
$model = new Saldo();
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
                <a href="RegistroSaldo.php">Nuevo Registro</a>
            </nav>
    </header>
    <section>
        <h1 class="heading">Listado de Saldos</h1>
        <table>
            <tr>
                <th>Id</th>
                <th>Id Banco</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <thbody>
                <?php
                    //Conexion de la bd
                    require_once("../MODELOS/conexion.php");
                    //Consulta
                    $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
                    $STH = $DBH->prepare("SELECT * FROM Saldo INNER JOIN Banco ON Saldo.id_banco = Banco.id_banco");
                    $STH->execute();
                    while ($resultado = $STH->fetch()) {
                    ?>
                        <tr>
                            <th><?php echo $resultado['id_saldo']; ?></th>
                            <th><?php echo $resultado['nombre_banco']?></th>
                            <th><?php echo $resultado['cantidad']; ?></th>
                            <th><?php echo $resultado['fecha']; ?></th>
                            <th>
                                <a class='btn-editar' href="EditarSaldo.php?id_saldo=<?php echo $resultado['id_saldo'];?>">Editar</a>
                            </th>
                        </tr>
                    <?php
                    }
                ?>
            </thbody>
        </table>
    </section>
</body>
</html>