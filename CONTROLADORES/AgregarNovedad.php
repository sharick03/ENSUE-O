<?php
require_once('../MODELOS/novedad.php');
if ($_POST) {
    $ModeloNovedad = new Novedad();
    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $fecha = gmdate("Y-m-d");
    $descripcion = $_POST['descripcion'];
    $ModeloNovedad->Agregar($id_usuario, $fecha, $descripcion);
} else {
    header('Location: ../VISTAS/Novedad.php');
}
?>
