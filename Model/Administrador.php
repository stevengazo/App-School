<?php

/**
 * Dependencias
 */
require_once "./connections/conexion.php";


// Modelo de clase para las notas
class Administrador
{

    // Conexión a la Base de Datos
    private $conexionDB;

    // Implementación en Singleton
    private static $instancia  = null;

    /**
     * Funcion para comprobar si hay más de una instancia creada, si no hay, la inicializa
     */
    public static function getInstancia()
    {
        if (self::$instancia == null) {
            self::$instancia = new Administrador();
        }
        return self::$instancia;
    }


    public function __construct()
    {
    }

    /**
     * Valida el inicio de sesción con los datos de la tabla administrador
     */

    function val_login($usu,$pass){

        $this->ins_conexion = new conexion();
        $this->obj_conexion = $this->ins_conexion->conectar();
    
        $sql  = "SELECT id,loging,clave FROM administrador";
        $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
    
         $rs = $this->obj_conexion->query($sql);
         $this->ins_conexion->desconectar();
         return $rs;
        }
    


}


?>