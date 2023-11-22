<?php
require_once('../MODELOS/Novedad.php');
if($_POST){
    $ModeloNovedad=new Novedad();
    $id_usuario=$_POST['id_novedad'];
    $ModeloNovedad->Eliminar($id_novedad);
    }
    else{
        header('Location: ../VISTAS/Novedades.php');
    }
?>