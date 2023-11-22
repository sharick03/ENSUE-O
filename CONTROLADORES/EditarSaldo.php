<?php
require_once('../MODELOS/saldo.php');
if($_POST){
    $ModeloSaldo=new Saldo();
    $id_banco=$_POST['id_banco'];
    $fecha=$_POST['fecha'];
    $cantidad=$_POST['cantidad'];
    $id_saldo=$_POST['id_saldo'];
    $ModeloSaldo->Actualizar($id_banco, $fecha, $cantidad, $id_saldo);
    }else{
        header('Location:../VISTAS/Saldo.php');
    }
?>