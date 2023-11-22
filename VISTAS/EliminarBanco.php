<?php
require_once('../MODELOS/banco.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$model = new Banco();
$model->id_banco=$_GET["id_banco"];
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
    <title>MISCELANEA Y PAPELERIA ENSUEÑO</title>
</head>
<body>
    <header>
        <a class="logo"><?php echo $_SESSION['nombreUsuario']; ?></a>
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="fa fa-bars"></label>
            <nav class="navbar">
                <a href="Banco.php">Volver</a>
            </nav>
    </header>
    <section class="formulario" id="formulario">
        <form action="../CONTROLADORES/EliminarBanco.php" method="POST" enctype="multipart/form-data">
            <h1 class="heading">Eliminar Bancos</h1>
                <div class="inputcaja">
                    <p>Está a punto de eliminar un Banco ¿Desea Continuar?</p>
                    <input type="hidden" name="id_banco" value="<?php echo $model->id_banco;?>">   <!--CON EL VALOR DEL ID DE BANCO SE PUEDE LLAMAR AL CONTROLADOR ELIMINARBANCO.PHP-->
                </div>
                <button class="btn" type="submit">Eliminar</button>
        </form>
    </section>
</body>
</html>