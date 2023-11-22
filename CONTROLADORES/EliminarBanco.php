<?php
require_once('../MODELOS/banco.php');
if($_POST){
    $ModeloBanco=new Banco();
    $id_banco=$_POST['id_banco'];
    $ModeloBanco->Eliminar($id_banco);
    }
    else{
        header('Location: ../VISTAS/Banco.php');
    }
?>