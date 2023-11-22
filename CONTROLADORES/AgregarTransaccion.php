<?php
require_once('../MODELOS/transaccion.php');
if($_POST){
    $ModeloTransaccion=new Transaccion();
    $id_usuario=$_SESSION['id_usuario'];
    //var_dump($id_usuario);
    $id_banco=$_POST['id_banco'];
    //var_dump($id_banco);
    $tipo_transaccion=$_POST['tipo_transaccion'];
    //var_dump($tipo_transaccion);
    $valor_transaccion=$_POST['valor_transaccion'];
    //var_dump($valor_transaccion);
    //seleccionar el id del saldo para el banco tal
    $id_saldo=$ModeloTransaccion->SaldoBanco($id_banco);
    // var_dump($id_saldo);
    $ModeloTransaccion->Agregar($id_usuario, $id_banco, $id_saldo, $tipo_transaccion, $valor_transaccion);
    
    //Calcular el nuevo saldo
    if($_POST ['tipo_transaccion'] == 'abono'){
      $ModeloTransaccion->AbonarSaldo($id_saldo, $valor_transaccion);

    }
    if($_POST ['tipo_transaccion'] == 'retiro'){
      $ModeloTransaccion->RetirarSaldo($id_saldo, $valor_transaccion);
    }

    }else{
      header('Location: ../VISTAS/Transaccion.php');
    }
?>