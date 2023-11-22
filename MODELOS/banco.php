<?php
require_once('conexion.php');
class Banco{
    private $pdo;   //VARIABLE PARA CONEXION
    public $id_banco;
    public $nombre_banco;

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

    //MÉTODO PARA OBTENER EL ID DE UN BANCO
    public function Obtener($id_banco){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarbancoporid (:id_banco)");
        $stm->bindParam(':id_banco',$id_banco);
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA CONSULTAR BANCO
    public function Listar(){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarbanco()");
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA AGREGAR BANCO
    public function Agregar($nombre_banco){
        // Verificar si el banco ya existe
        $verificarStmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM Banco WHERE nombre_banco = :nombre_banco");
        $verificarStmt->bindParam(':nombre_banco', $nombre_banco);
        $verificarStmt->execute();
        $result = $verificarStmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            // El banco ya existe, redireccionar a la página de error o mostrar un mensaje
            echo '<script language="javascript">alert("Banco ya existente"); window.location.href="../VISTAS/RegistroBanco.php";</script>';
        } else {
            // El banco no existe, realizar la inserción
            $stm = $this->pdo->prepare("call pa_insertarbanco (:nombre_banco)");
            $stm->bindParam(':nombre_banco', $nombre_banco);
    
            if ($stm->execute()) {
                header('Location:../VISTAS/ResultadoBanco.php');
            } else {
                // Manejar el error en caso de que la inserción no sea exitosa
                header('Location:../VISTAS/RegistroBanco.php');
            }
        }
    }
    

    //MÉTODO PARA ACTUALIZAR BANCO
    public function Actualizar($nombre_banco, $id_banco){
        $stm=$this->pdo->prepare("call pa_actualizarbanco (:id_banco, :nombre_banco)");
        $stm->bindParam(':nombre_banco', $nombre_banco);
        $stm->bindParam(':id_banco', $id_banco);
        if($stm->execute()){
            header('Location:../VISTAS/Banco.php');
        }else{
            header('Location:../VISTAS/EditarBanco.php');
        }
    }

    //MÉTODO PARA ELIMINAR BANCO
    public function Eliminar($id_banco){
        $stm=$this->pdo->prepare("call pa_eliminarbanco(:id_banco)");
        $stm->bindParam(':id_banco',$id_banco);
        if($stm->execute()){
            header('Location:../VISTAS/Banco.php');
        }else{
            header('Location:../VISTAS/EliminarBanco.php');
        }
    }
}
?>