<?php
require_once('../MODELOS/saldo.php');
require_once('../MODELOS/conexion.php');
require_once('../MODELOS/login.php'); //PARA TRAER EL NOMBRE DEL USUARIO
$model = new Saldo();
$model->id_saldo=$_GET["id_saldo"];
$Saldo=$model->Obtener($model->id_saldo);
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
                <a href="Saldo.php">Volver</a>
            </nav>
    </header>
    <?php
        if($Saldo!=null){
        foreach($Saldo as $datos){
    ?>
    <section class="formulario" id="formulario">
        <form action="../CONTROLADORES/EditarSaldo.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_saldo" value="<?php echo $datos["id_saldo"]; ?>" />
            <h1 class="heading">Registro De Edición De Saldo</h1>
                <div class="inputcaja">
                    <select name="id_banco" required="true">
                    <option value="" disabled selected>Banco</option>
                    <?php
                    try {
                        //crear conexion a la bd
                        $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
                       //preparar la sentencia
                        $STH = $DBH->prepare("select * from banco");
                        $STH->execute();
                        //Realizar ciclo para que recorra el arreglo
                        while($row = $STH->fetch()) {
                                    //creacion de variable en la cual se va guardar el array
                                    $idbanco =  $row["id_banco"];
                                    echo "<option  value='$idbanco' >";
                                    echo $row["nombre_banco"];
                                    echo "</option>";
                        }

                    }
                    catch(PDOException $e) {
                        echo "I'm sorry, Dave. I'm afraid I can't do that.";
                        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
                    }
                    ?>
                    </select>
                </div><br>
                <div class="inputcaja">
                    <input type="datetime" name="fecha" value="<?php echo $datos["fecha"]; ?>" required="true">
                    <label for="">Fecha</label>
                </div>
                <div class="inputcaja">
                    <input type="float" name="cantidad" value="<?php echo $datos["cantidad"]; ?>" required="true">
                    <label for="">Cantidad</label>
                </div>
                <button type="submit" class="btn">GUARDAR</button>
        </form>
    </section>
    <?php
            }
        }
    ?>
</body>
</html>