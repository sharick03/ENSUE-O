<?php
require_once('conexion.php');

class Novedad {
    private $pdo;
    public $id_novedad;
    public $id_usuario;
    public $fecha;
    public $descripcion;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Conexion::StartUp();
        } catch (Exception $e) {
            echo "Hay problemas de conexión";
            die($e->getMessage());
        }
    }

    // MÉTODO PARA OBTENER EL ID NOVEDAD
    public function Obtener($id_novedad){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarnovedadporid (:id_novedad)");
        $stm->bindParam(':id_novedad',$id_novedad);
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    // MÉTODO PARA CONSULTAR NOVEDADES
    public function Listar(){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarnovedad()");
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    // MÉTODO PARA AGREGAR UNA NOVEDAD
    public function Agregar($id_usuario, $fecha, $descripcion){
        $stm=$this->pdo->prepare("call pa_insertarnovedad (:id_usuario, :fecha, :descripcion)");
        $stm->bindParam(':id_usuario', $_SESSION['id_usuario']);
        $stm->bindParam(':fecha', $fecha);
        $stm->bindParam(':descripcion', $descripcion);
        if($stm->execute()){
            header('Location:../VISTAS/ResultadoNovedad.php');
        }else{
            header('Location:../VISTAS/RegistroNovedad.php');
        }
    }
    
    // MÉTODO PARA ELIMINAR UNA NOVEDAD
    public function Eliminar($id_novedad) {
        $stm=$this->pdo->prepare("call pa_eliminarnovedad (:id_novedad)");
        $stm->bindParam(':id_novedad', $id_novedad);
        if($stm->execute()){
            header('Location:../VISTAS/Novedades.php');
        }else{
            header('Location:../VISTAS/EliminarNovedad.php');
        }
    }
}
?>
