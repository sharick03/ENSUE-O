<?php
require_once('../MODELOS/usuario.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$model = new Usuario();
$model->id_usuario=$_GET["id_usuario"];
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
                <a href="Usuario.php">Volver</a>
            </nav>
    </header>
    <section class="formulario" id="formulario">
        <form action="../CONTROLADORES/EliminarUsuario.php" method="POST" enctype="multipart/form-data">
            <h1 class="heading">Eliminar Usuario</h1>
                <div class="inputcaja">
                    <p>Está a punto de eliminar un registro ¿Desea Continuar?</p>
                    <input type="hidden" name="id_usuario" value="<?php echo $model->id_usuario;?>">   <!--CON EL VALOR DEL ID DE USUARIO SE PUEDE LLAMAR AL CONTROLADOR ELIMINARUSUARIO.PHP-->
                </div>
                <button class="btn" type="submit">Eliminar</button>
        </form>
    </section>
</body>
</html>