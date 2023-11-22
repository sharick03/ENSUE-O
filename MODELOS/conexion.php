<?php
class Conexion{
    public static function StartUp()
    {
        //VARIABLE PDO PARA CONECTARSE
        //se crea una instancia pdo y el PDO seria un objeto de la clase
        $pdo = new PDO('mysql:host=localhost;dbname=ensueno;charset=utf8', 'root', ''); //Encontramos el servidor,nom,idioma,usua,con
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //APLICA ATRIBUTOS DE ERRORES
        return $pdo;
    }
}
?>