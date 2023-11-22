<?php
session_start();
require_once('../MODELOS/login.php');

if ($_POST) {
    $Usuario = $_POST['nombreUsuario'];
    $Clave = $_POST['clave'];
    $Modelo = new login();
    $entrada = $Modelo->login($Usuario, $Clave);
    
    if ($entrada != false) {
        if ($_SESSION['id_usuario'] == 1) {
            header('Location: ../VISTAS/Dashboard.php');
        } else {
            header('Location: ../VISTAS/Dashboard.php');
        }
    } else {
        $_SESSION['error_message'] = 'Usuario no existente'; // Almacena el mensaje de error
        header('Location: ../VISTAS/Login.php');
    }
}
?>
