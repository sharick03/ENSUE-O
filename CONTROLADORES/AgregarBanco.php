<?php
require_once('../MODELOS/banco.php');
if($_POST){
    $ModeloBanco=new Banco();
    $nombre_banco=$_POST['nombre_banco'];
    $ModeloBanco->Agregar($nombre_banco);
    }else{
        header('Location: ../VISTAS/Banco.php');
    }
?>

