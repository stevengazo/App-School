<?php

    /**
     * DEPENDENCIAS
     */
    require_once "libs/smarty4_1_1/config_smarty.php";
    require_once "Model/Falta_Asistencia.php";
    require_once "connections/conexion.php";
    require_once "Model/Nota.php";

    class FaltaAsistenciaController{
        private $Smarty;
        private $FaltaAsistencia;
        private $Nota;

        function __construct(){
            $this->Smarty= new config_smarty();
            $this->FaltaAsistencia = Falta_Asistencia::getInstancia();
            $this->Nota = Nota::getInstance();
        }

        private static $instance = null;

        /**
         * Funcion para inicializar singleton
         * Si hay más de una instancia borra  la información
         */
        public static function getInstancia(){
            if(self::$instance == null ){
                self::$instance = new Falta_Asistencia();
            }
            return self::$instance;
        }    
    
     

        /**
         * Descripción: Gestión de la información recibida por el controllador
         */
       function gestor(){
        
        }
    }