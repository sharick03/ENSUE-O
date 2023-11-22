<?php
require_once('../MODELOS/banco.php');
if($_POST){
    $ModeloBanco=new Banco();
    $nombre_banco=$_POST['nombre_banco'];
    $id_banco=$_POST['id_banco'];
    $ModeloBanco->Actualizar($nombre_banco, $id_banco);
    }else{
        header('Location:../VISTAS/Banco.php');
    }
?>