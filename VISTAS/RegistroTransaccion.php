<?php
require_once('../MODELOS/login.php');//PARA TRAER EL NOMBRE DEL USUARIO
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
            <a href="Transacciones.php">Volver</a>
        </nav>
    </header>
    <section class="formulario" id="formulario">
        <?php
        require_once("../MODELOS/conexion.php");
        $DBH = new PDO("mysql:host=localhost;dbname=ensueno", "root", "");
        $STH = $DBH->prepare("SELECT * FROM Saldo INNER JOIN Banco ON Saldo.id_banco = Banco.id_banco");
        $STH->execute();
        ?>
        <div class="cards-container">
            <?php while ($resultado = $STH->fetch()) { ?>
                <div class="card">
                    <h3><?php echo $resultado['nombre_banco']; ?></h3>
                    <p>Saldo: <?php echo $resultado['cantidad']; ?></p>
                </div>
            <?php } ?>
        </div>
        <form action="../CONTROLADORES/AgregarTransaccion.php" method="POST" enctype="multipart/form-data">
        <h1 class="heading">Registrar Transacciones</h1>
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
                                        $id_banco =  $row["id_banco"];
                                        echo "<option  value='$id_banco' >";
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
                <input type="radio" value="retiro" name="tipo_transaccion" required="true" id="retiro">
                <label for="retiro">Retiro</label><br>
            </div>
            <div class="inputcaja">
                <input type="radio" value="abono" name="tipo_transaccion" required="true" id="abono">
                <label for="abono">Abono</label><br>
            </div>
            <div class="inputcaja"><br>
                <input type="number" step="0.01" name="valor_transaccion" required="true">
                <label for="valorTransaccion">Valor transacción<span class="required">*</span></label>
            </div>
            <div class="inputcaja"><br>
            <div class="inputcaja">
            <p>Fecha: <?php echo gmdate("d-m-Y"); ?></p>
            </div><br><br>
            <button type="submit" class="btn">GUARDAR</button>
        </form>
    </section>
</body>
</html>
