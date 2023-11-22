<?php
require_once('../MODELOS/usuario.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$model = new Usuario();
$model->id_usuario=$_GET["id_usuario"];
$Usuario=$model->Obtener($model->id_usuario);
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
                <a href="Usuario.php">Volver</a>
            </nav>
    </header>
    <?php
        if($Usuario!=null){
        foreach($Usuario as $datos){
    ?>
    <section class="formulario" id="formulario">
        <form action="../CONTROLADORES/EditarUsuario.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?php echo $datos["id_usuario"]; ?>" />
            <h1 class="heading">Editar Usuario</h1>
                <div class="inputcaja">
                    <input type="varchar" name="nombreUsuario" value="<?php echo $datos["nombreUsuario"]; ?>" required="true">
                    <label for="">Nombre</label>
                </div>
                <div class="inputcaja">
                    <input type="varchar" name="apellidoUsuario" value="<?php echo $datos["apellidoUsuario"]; ?>" required="true">
                    <label for="">Apellido</label>
                </div>
                <div class="inputcaja">
                    <input type="email" name="correo" value="<?php echo $datos["correo"]; ?>" required="true">
                    <label for="">Correo</label>
                </div>
                <div class="inputcaja">
                    <input type="password" name="clave" value="<?php echo $datos["clave"]; ?>" required="true">
                    <label for="">Clave</label>
                </div>
                <div class="inputcaja">
                    <select name="rol" required="true">
                        <option value="" disabled selected>Rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                </div><br>
                <button type="submit" class="btn">GUARDAR</button>
        </form>
    </section>
    <?php
            }
        }
    ?>
</body>
</html>