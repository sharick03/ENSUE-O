<?php
require_once('conexion.php');
class Saldo{
    private $pdo;   //VARIABLE PARA CONEXION
    public $id_saldo;
    public $id_banco;
    public $fecha;
    public $cantidad;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = Conexion::StartUp(); //SE CONECTA CON LA BASE DE DATO
        }
        catch(Exception $e)
        {   echo "HAY PROBLEMAS DE CONEXION";
            die($e->getMessage());
        }
    }

    //MÉTODO PARA OBTENER EL ID DE UN SALDO
    public function Obtener($id_saldo){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarsaldoporid (:id_saldo)");
        $stm->bindParam(':id_saldo',$id_saldo);
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA CONSULTAR UN SALDO
    public function Listar(){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarsaldo()");
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA AGREGAR UN SALDO
    public function Agregar($id_banco, $fecha, $cantidad){
        $stm=$this->pdo->prepare("call pa_insertarsaldo (:id_banco, NOW(), :cantidad)");
        $stm->bindParam(':id_banco',$id_banco);
        $stm->bindParam(':cantidad',$cantidad);
        if($stm->execute()){
            header('Location:../VISTAS/ResultadoSaldo.php');
        }else{
            header('Location:../VISTAS/RegistroSaldo.php');
        }
    }

    //MÉTODO PARA ACTUALIZAR UN SALDO
    public function Actualizar($id_banco, $fecha, $cantidad, $id_saldo){
        $stm=$this->pdo->prepare("call pa_actualizarsaldo (:id_saldo, :id_banco, :fecha, :cantidad)");
        $stm->bindParam(':id_banco',$id_banco);
        $stm->bindParam(':fecha',$fecha);
        $stm->bindParam(':cantidad',$cantidad);
        $stm->bindParam(':id_saldo', $id_saldo);
        if($stm->execute()){
            header('Location:../VISTAS/Saldo.php');
        } else {
            header('Location:../VISTAS/EditarSaldo.php');
        }
    }
}
?>