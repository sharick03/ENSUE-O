<?php
session_start();
require_once('conexion.php');

class login {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = conexion::StartUp();
        } catch (Exception $e) {
            echo "HAY PROBLEMAS DE CONEXION";
            die($e->getMessage());
        }
    }

    public function login($Usuario, $Clave) {
        $stm = $this->pdo->prepare("SELECT * FROM Usuario WHERE nombreUsuario = :nombreUsuarioI AND clave = :claveI");
        $stm->bindParam(':nombreUsuarioI', $Usuario, PDO::PARAM_STR);
        $stm->bindParam(':claveI', $Clave, PDO::PARAM_STR);
        $stm->execute();

        if ($stm->rowCount() == 1) {
            $result = $stm->fetch();
            
            $_SESSION['nombreUsuario'] = $result["nombreUsuario"];
            $_SESSION['id_usuario'] = $result['id_usuario'];
            return $result['nombreUsuario'];
        }

        return false; // Usuario no encontrado
    }

    public function GetIdUsuario() {
        return $_SESSION['id_usuario'];
    }
}
?>
