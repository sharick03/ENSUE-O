<?php
require_once('../MODELOS/saldo.php');
if($_POST){
    $ModeloSaldo=new Saldo();
    $id_banco=$_POST['id_banco'];
    $cantidad=$_POST['cantidad'];
    //var_dump($cantidad);
    //var_dump($_POST);
    $ModeloSaldo->Agregar($id_banco, $fecha, $cantidad);
    }else{
        header('Location: ../VISTAS/Saldo.php');
    }
?>