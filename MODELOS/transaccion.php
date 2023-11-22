<?php
session_start();
require_once('conexion.php');
class Transaccion{
    private $pdo;   //VARIABLE PARA CONEXION
    public $id_transaccion;
    public $id_usuario;
    public $id_banco;
    public $id_saldo;
    public $tipo_transaccion;
    public $valor_transaccion;
    public $fecha;

    public function __construct()
    {
        try
        {
            $this->pdo = Conexion::StartUp(); //SE CONECTA CON LA BASE DE DATO
        }
        catch(Exception $e)
        {   echo "HAY PROBLEMASDE CONEXION";
            die($e->getMessage());
        }
    }

    //MÉTODO PARA OBTENER EL ID TRANSACCIÓN
    public function Obtener($id_transaccion){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultartransaccionporid (:id_transaccion)");
        $stm->bindParam(':id_transaccion',$id_transaccion);
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA CONSULTAR TRANSACCIÓN
    public function Listar(){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultartransaccion()");
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA AGREGAR TIPO DE TRANSACCIÓN
    public function Agregar($id_usuario, $id_banco, $id_saldo, $tipo_transaccion, $valor_transaccion){
        $stm=$this->pdo->prepare("call pa_insertartransaccion (:id_usuario, :id_banco, :id_saldo, :tipo_transaccion, :valor_transaccion, CURDATE())");
        $stm->bindParam(':id_usuario',$_SESSION['id_usuario']);
        $stm->bindParam(':id_banco',$id_banco);
        $stm->bindParam(':id_saldo',$id_saldo);
        $stm->bindParam(':tipo_transaccion',$tipo_transaccion);
        $stm->bindParam(':valor_transaccion',$valor_transaccion);
        if($stm->execute()){
            header('Location:../VISTAS/ResultadoTransaccion.php');
        }else{
            header('Location:../VISTAS/RegistroTransaccion.php');
        }
    }
    
    //METODO PARA CONSULTAR SALDOS POR EL ID DEL BANCO Y FECHA
    public function SaldoBanco($id_banco){
        $rows = [];
        $stm=$this->pdo->prepare("SELECT id_saldo FROM saldo  WHERE id_banco = :id_banco and fecha = CURDATE()");
        $stm->bindParam(':id_banco',$id_banco);
        $i = $stm->execute();
        $rowset = $stm->fetchAll(PDO::FETCH_NUM);
        return $rowset[0][0];
    }

    //METODO PARA ABONAR SALDO
    public function AbonarSaldo($id_saldo, $valor_transaccion){
        $stm=$this->pdo->prepare("UPDATE Saldo SET cantidad = cantidad + :valor_transaccion WHERE id_saldo = :id_saldo");
        $stm->bindParam(':id_saldo',$id_saldo);
        $stm->bindParam(':valor_transaccion',$valor_transaccion);
        $stm->execute();
    }

     //METODO PARA RETIRAR SALDO
    public function RetirarSaldo($id_saldo, $valor_transaccion){
        $stm=$this->pdo->prepare("UPDATE Saldo SET cantidad = cantidad - :valor_transaccion WHERE id_saldo = :id_saldo");
        $stm->bindParam(':id_saldo',$id_saldo);
        $stm->bindParam(':valor_transaccion',$valor_transaccion);
        $stm->execute();
    }
}
?>