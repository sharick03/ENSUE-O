<?php
require_once('../MODELOS/usuario.php');
if($_POST){
    $ModeloUsuario=new Usuario();
    $nombreUsuario=$_POST['nombreUsuario'];
    $apellidoUsuario=$_POST['apellidoUsuario'];
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $rol=$_POST['rol'];
    $ModeloUsuario->Agregar($nombreUsuario, $apellidoUsuario, $correo, $clave, $rol);
    }else{
        header('Location: ../VISTAS/Usuario.php');
    }
?>