<?php
require_once('../MODELOS/novedad.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$model = new Novedad();
$model->id_novedad=$_GET["id_novedad"];
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
        <form action="../CONTROLADORES/EliminarNovedad.php" method="POST" enctype="multipart/form-data">
            <h1 class="heading">Novedad Resuelta</h1>
                <div class="inputcaja">
                    <p>¿Desea Continuar?</p>
                    <input type="hidden" name="id_novedad" value="<?php echo $model->id_novedad;?>">   <!--CON EL VALOR DEL ID DE USUARIO SE PUEDE LLAMAR AL CONTROLADOR ELIMINARUSUARIO.PHP-->
                </div>
                <button class="btn" type="submit">Resuelto</button>
        </form>
    </section>
</body>
</html>