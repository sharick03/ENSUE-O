<?php
require_once('conexion.php');
class Usuario{
    private $pdo;   //VARIABLE PARA CONEXION
    public $id_usuario;
	public $nombreUsuario;
    public $apellidoUsuario;
    public $correo;
    public $clave;
    public $rol;

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

    //MÉTODO PARA OBTENER EL ID DE UN USUARIO
    public function Obtener($id_usuario){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarusuarioporid (:id_usuario)");
        $stm->bindParam(':id_usuario',$id_usuario);
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA CONSULTAR UN USUARIO
    public function Listar(){
        $rows=null;
        $stm=$this->pdo->prepare("call pa_consultarusuario()");
        $stm->execute();
        while($result=$stm->fetch()){
                $rows[]=$result;
        }
        return $rows;
    }

    //MÉTODO PARA AGREGAR UN USUARIO
    public function Agregar($nombreUsuario, $apellidoUsuario, $correo, $clave, $rol){
        $verificarStmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM Usuario WHERE nombreUsuario = :nombreUsuario AND correo = :correo");
        $verificarStmt->bindParam(':nombreUsuario', $nombreUsuario);
        $verificarStmt->bindParam(':correo', $correo);
        $verificarStmt->execute();
        $result = $verificarStmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            //usuario ya existente
            echo '<script language="javascript">alert("Usuario ya existente"); window.location.href="../VISTAS/RegistroUsuario.php";</script>';
            return;
        }
        $stm = $this->pdo->prepare("call pa_insertarusuario (:nombreUsuario, :apellidoUsuario, :correo, :clave, :rol)");
        $stm->bindParam(':nombreUsuario', $nombreUsuario);
        $stm->bindParam(':apellidoUsuario', $apellidoUsuario);
        $stm->bindParam(':correo', $correo);
        $stm->bindParam(':clave', $clave);
        $stm->bindParam(':rol', $rol);
        if ($stm->execute()){
            header('Location:../VISTAS/ResultadoUsuario.php');
        } else {
            header('Location:../VISTAS/RegistroUsuario.php');
        }
    }
    

    //MÉTODO PARA ACTUALIZAR UN USUARIO
    public function Actualizar($nombreUsuario, $apellidoUsuario, $correo, $clave, $rol, $id_usuario){
        $stm=$this->pdo->prepare("call pa_actualizarusuario (:id_usuario, :nombreUsuario, :apellidoUsuario, :correo, :clave, :rol)");
        $stm->bindParam(':nombreUsuario',$nombreUsuario);
        $stm->bindParam(':apellidoUsuario',$apellidoUsuario);
        $stm->bindParam(':correo',$correo);
        $stm->bindParam(':clave',$clave);
        $stm->bindParam(':rol',$rol);
        $stm->bindParam(':id_usuario', $id_usuario);
        if($stm->execute()){
        header('Location:../VISTAS/Usuario.php');
        }else{
        header('Location:../VISTAS/EditarUsuario.php');
        }
    }

    //MÉTODO PARA ELIMINAR UN USUARIO
    public function Eliminar($id_usuario){
        $stm=$this->pdo->prepare("call pa_eliminarusuario (:id_usuario)");
        $stm->bindParam(':id_usuario',$id_usuario);
        if($stm->execute()){
        header('Location:../VISTAS/Usuario.php');
        }else{
        header('Location:../VISTAS/EliminarUsuario.php');
        }
    }
}
?>