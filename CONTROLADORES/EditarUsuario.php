<?php
require_once('../MODELOS/usuario.php');
if($_POST){
    $ModeloUsuario=new Usuario();
    $nombreUsuario=$_POST['nombreUsuario'];
    $apellidoUsuario=$_POST['apellidoUsuario'];
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $rol=$_POST['rol'];
    $id_usuario=$_POST['id_usuario'];
    $ModeloUsuario->Actualizar($nombreUsuario, $apellidoUsuario, $correo, $clave, $rol, $id_usuario);
    }else{
        header('Location:../VISTAS/Usuario.php');
    }
?>