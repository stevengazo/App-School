<?php
    /**
     * DEPENDENCIAS
     */
    require_once "connections/conexion.php";
    class Nivel
    {
        /**
        * Conexión con la Base de Datos
        */
        private $ins_conexion;
        private $obj_conexion;

        /**
        * Implementación con singleton
        */
        private static $instance = null;

        /**
        * Funcion para inicializar singleton
        * Si hay más de una instancia borra  la información
        */
        public static function getInstancia(){
            if(self::$instance == null ){
                self::$instance = new Nivel();
            }
            return self::$instance;
        }

        public function __construct()
        {
        }

        function insert_nivel($id,$nivel,$curso,$aula)
        {
            try{

              $this->ins_conexion = new conexion();
              $this->obj_conexion = $this->ins_conexion->conectar();
                // QUERY PARA INGRESAR A LA DB
                $sql = "INSERT INTO nivel (id,nivel,curso,AULA)";
                $sql .= "values ('$id','$nivel','$curso','$aula')";
                $sqlResults = $this->obj_conexion->query($sql);
                $this->ins_conexion->desconectar();
                return true;
            }catch(Exception $error){
                echo "Error in insertarNivel".$error->getMessage();
                return null;
            }

        }

    }
