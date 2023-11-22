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
                <a href="Saldo.php">Volver</a>
            </nav>
    </header>
    <section class="formulario" id="formulario">
        <form action="../CONTROLADORES/AgregarSaldo.php" method="POST" enctype="multipart/form-data">
            <h1 class="heading">Registrar Saldo</h1>
                <div class="inputcaja">
                <i class="fas fa-university"></i>
                    <select name="id_banco" required>
                    <option value="" disabled selected>Banco</option>
                    <?php
                    try {
                        //crear conexion a la bd
                        $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
                       //preparar la sentencia
                        $STH = $DBH->prepare("SELECT * FROM banco");
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
                    <span class="required">*</span>
                </div><br>
                <div class="inputcaja">
                    <input type="float" name="cantidad" required="true">
                    <label for="">Cantidad<span class="required">*</span></label>
                </div>
                <div class="inputcaja"><br>
                    <p> Fecha: <?php echo date("d-m-Y");?></p>
                </div>
                <button type="submit" class="btn">GUARDAR</button>
        </form>
    </section>
</body>
</html>