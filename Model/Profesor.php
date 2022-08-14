<?php

require_once "connections/conexion.php";

class Profesor{

  private $ins_conexion;
  private $obj_conexion;
  private static $instance=null;

  public static function getInstance(){

    if(self::$instance==null){
        self::$instance = new Profesor();
    }
      return self::$instance;
  }


    function insert_profesor($id,$usuario,$pass,$nombre,$apellidos,$email,$esp)
    {
        try{

          $this->ins_conexion = new conexion();
          $this->obj_conexion = $this->ins_conexion->conectar();
            // QUERY PARA INGRESAR A LA DB
            $sql = "INSERT INTO profesor (id, login, clave, nombre, apellidos, email, especialista)";
            $sql .= "values ('$id','$usuario','$pass','$nombre','$apellidos','$email','$esp')";
            $sqlResults = $this->obj_conexion->query($sql);
            $this->ins_conexion->desconectar();
            return true;
        }catch(Exception $error){
            echo "Error in insertarProfesor".$error->getMessage();
            return null;
        }

    }

    function val_login($usu,$pass){

    $this->ins_conexion = new conexion();
    $this->obj_conexion = $this->ins_conexion->conectar();

    $sql  = "SELECT id,login,clave FROM profesor";
    $sql .= " WHERE  login='$usu' AND clave= '$pass'";
     $rs = $this->obj_conexion->query($sql);
     $this->ins_conexion->desconectar();
     return $rs;
    }

}
 ?>
