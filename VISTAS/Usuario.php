<?php
require_once('../MODELOS/usuario.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$ModeloUsuario=new Usuario();
$model = new Usuario();
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
                <a href="RegistroUsuario.php">Nuevo Registro</a>
            </nav>
    </header>
    <section>
    <h1 class="heading">Listado de Usuarios</h1>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php
            $Usuario=$model->Listar();
                if($Usuario!=null){
                    foreach($Usuario as $r){
            ?>
                <tr>
                    <td><?php echo $r['id_usuario']; ?></td>
                    <td><?php echo $r['nombreUsuario']; ?></td>
                    <td><?php echo $r['apellidoUsuario']; ?></td>
                    <td><?php echo $r['correo']; ?></td>
                    <td><?php echo $r['rol']; ?></td>
                    <td>
                        <a class='btn-editar' href="EditarUsuario.php?id_usuario=<?php echo $r['id_usuario'];?>">Editar</a><!--INDICA QUE CONTROLADOR Y QUE ACCION EJECUTAR, EN ESTE CASO LLAMARIA AL
                        ARCHIVO EditarUsuario.php PASANDO EL ID COMO PARÁMETRO-->
                        <a class='btn-eliminar' href="EliminarUsuario.php?id_usuario=<?php echo $r['id_usuario'];?>">Eliminar<a><!--INDICA QUE CONTROLADOR Y QUE ACCION EJECUTAR, EN ESTE CASO LLAMARIA AL
                        ARCHIVO EliminarUsuario.php PASANDO EL ID COMO PARÁMETRO-->
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
        </table>
    </section>
</body>
</html>