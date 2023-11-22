<?php
require_once('../MODELOS/banco.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$ModeloBanco=new Banco();
$model = new Banco();
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
                <a href="RegistroBanco.php">Nuevo Registro</a>
            </nav>
    </header>
    <section>
        <h1 class="heading">Listado de Bancos</h1>
        <table>
            <tr>
                <th>Id</th>
                <th>Banco</th>
                <th>Acciones </th>
            </tr>
            <tbody>
            <?php
            $Banco=$model->Listar();
                if($Banco!=null){
                    foreach($Banco as $r){
            ?>
            <tr>
                <td><?php echo $r['id_banco']; ?></td>
                <td><?php echo $r['nombre_banco']; ?></td>
                <td>
                    <a class='btn-editar' href="EditarBanco.php?id_banco=<?php echo $r['id_banco'];?>">Editar</a><!--INDICA QUE CONTROLADOR Y QUE ACCION EJECUTAR, EN ESTE CASO LLAMARIA AL
                    ARCHIVO EDITARTipoTransaccion.PHP PASANDO EL ID COMO PARÁMETRO-->
                    <a class='btn-eliminar 'href="EliminarBanco.php?id_banco=<?php echo $r['id_banco'];?>">Eliminar<a><!--INDICA QUE CONTROLADOR Y QUE ACCION EJECUTAR, EN ESTE CASO LLAMARIA AL
                    ARCHIVO ELIMINARTipoTransaccion.PHP PASANDO EL ID COMO PARÁMETRO-->
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
        </table>
    </section>
</body>
</html>