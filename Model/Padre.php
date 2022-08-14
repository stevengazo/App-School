<?php

require_once "connections/conexion.php";

class Padre{

  private $ins_conexion;
  private $obj_conexion;
  private static $instance=null;

  public static function getInstance(){

    if(self::$instance==null){
        self::$instance = new  Padre();
    }
      return self::$instance;
  }



    function val_login($usu,$pass){

    $this->ins_conexion = new conexion();
    $this->obj_conexion = $this->ins_conexion->conectar();

    $sql  = "SELECT id,loging,clave FROM PADRE";
    $sql .= " WHERE  loging='$usu' AND clave= '$pass'";
     $rs = $this->obj_conexion->query($sql);
     $this->ins_conexion->desconectar();
     return $rs;
    }
}
 ?>
