<?php
require_once('../MODELOS/usuario.php');
if($_POST){
    $ModeloUsuario=new Usuario();
    $id_usuario=$_POST['id_usuario'];
    $ModeloUsuario->Eliminar($id_usuario);
    }
    else{
        header('Location: ../VISTAS/Usuario.php');
    }
?>