<?php
    /**
     * DEPENDENCIAS
     */
    require_once "connections/conexion.php";
    class Asignatura
    {
        /**
        * Conexión con la Base de Datos
        */
        private $conexionDb;

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
                self::$instance = new Asignatura();
            }
            return self::$instance;
        }    

        public function __construct()
        {
        }


        /**
         * Descripción: solamente regresa el id del alumno, nombre y apellido
         */
        function obtenerArregloAlumnosSimple(){
            try{
                $this->conexionDb = new conexion();
                $this->objConexion = $this->conexionDb->conectar();
                $sqlQuery = "SELECT id, nombre, apellidos from  alumno";
                $sqlResults = $this->objConexion->query($sqlQuery);
                $this->conexionDb->desconectar();
    
                $arrayResult = array();                
                while($fila = $sqlResults->fetch_assoc()){
                    $arrayTmp= array();
                    $arrayTmp['id'] = $fila['id'];
                    $arrayTmp['nombre'] = $fila['apellidos']." ".$fila['nombre'];                    
                    $arrayResult[]= $arrayTmp;
                }
                return $arrayResult;
            }catch(Exception $error){
                echo "Error in obtenerListaFaltaAsistencia. Error".$error->getMessage();
                return null;
            }
        }

    }
